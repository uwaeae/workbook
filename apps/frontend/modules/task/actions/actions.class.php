<?php

/**
 * task actions.
 *
 * @package    workbook
 * @subpackage task
 * @author     Florian Engler
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class taskActions extends sfActions
{


    public function executeIndex(sfWebRequest $request)
    {

        $this->taskmonth = Doctrine_Query::create()
            ->select('MONTH(t.start) month')
            ->from('Task t')
            ->groupBy('month')
            ->execute();
        $this->tasks = array();
        $this->worktime = 0;
        $this->overtime = 0;
        $this->sickness = 0;
        $this->holyday = 0;


        $t = Doctrine_Query::create()
            ->select('t.*, ')
            ->from('Task t')
            ->leftJoin('TaskUser u')
            ->where('u.user_id =' . $this->getUser()->getId())
            ->andWhere('MONTH(t.start) = MONTH(NOW()) ')
            ->execute();

        foreach ($t as $task) {
            $tmp = array();
            $start = strtotime($task->getStart());
            $diff = date_diff(new DateTime($task->getStart()), new DateTime($task->getEnd()));
            if ($diff->format('%d') > 0) {
                $Stunden = 0;
                for ($i = 1; $i < $diff->format('%d'); $i++) {
                    $date = mktime(0, 0, 0, date("m", $start), date("d", $start) + $i, date("Y", $start));
                    if (date('w', $date) != 0 or date('w', $date) != 6) {
                        $Stunden++;
                    }
                }

                $Stunden = $Stunden * 8;

            } else {
                $Stunden = date('H', strtotime($task->getEnd())) - date('H', strtotime($task->getStart())) - $task->getOvertime();
                $Minuten = (date('i', strtotime($task->getEnd())) - date('i', strtotime($task->getStart())));
                if (7 > $Minuten and $Minuten > -7) $Minuten = 0;
                if (-22 < $Minuten and $Minuten <= -8) $Minuten = -15;
                if (-37 < $Minuten and $Minuten <= -23) $Minuten = -30;
                if (-52 < $Minuten and $Minuten <= -38) $Minuten = -45;
                if ($Minuten >= 53) $Minuten = 0;
                if (22 > $Minuten and $Minuten >= 8) $Minuten = 15;
                if (37 > $Minuten and $Minuten >= 23) $Minuten = 30;
                if (52 > $Minuten and $Minuten >= 38) $Minuten = 45;

                if ($Minuten != 0) $Stunden += $Minuten / 60;
            }


            $this->overtime += $task->getOvertime();
            switch ($task->getTaskTypeId()) {
                case '1':
                    //	echo '<td>'.$Stunden.'</td><td>'.($task->getOvertime() == 0?' ':$task->getOvertime() ).'</td><td></td><td></td>';
                    $tmp['worktime'] = $Stunden;
                    $this->worktime += $Stunden;
                    break;
                case '2':
                    //	echo '<td></td><td>'.($task->getOvertime() == 0?' ':$task->getOvertime() ).'</td><td>'.$Stunden.'</td><td></td>';
                    $tmp['holyday'] = $Stunden;
                    $this->holyday += $Stunden;

                    break;
                case '3':
                    //	echo '<td></td><td>'.($task->getOvertime() == 0?' ':$task->getOvertime() ).'</td><td></td><td>'.$Stunden.'</td>';
                    $tmp['sickness'] = $Stunden;
                    $this->sickness += $Stunden;
                    break;
            }

            $tmp['task'] = $task;

            $this->tasks[] = $tmp;

        }

    }

    public function executeNew(sfWebRequest $request)
    {
        $this->back = $this->getUser()->getAttribute('back');
        $type = ($request->hasParameter('type') ? $request->getParameter('type') : 1);
        $this->getUser()->setFlash('type', $type);
        $task = new TaskForm(NULL, array(
            'type' => $type,
        ));
        $this->job = null;
        if ($request->hasParameter('job')) {

            $this->job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('job')));
            $jobid = $this->job->getId();
            // $this->back = "job/show?id=".$jobid;
            $this->tasks = Doctrine_Core::getTable('Task')->createQuery('t')
                ->where('t.job_id =' . $jobid)
                ->execute();


            $task->setDefault('job_id', $jobid);
        }


        unset($task['correction_info'], $task['correction_time']);


        if (!$this->getUser()->hasPermission('Zuweisen')) {
            $task->setWidget('users_list', new sfWidgetFormInputHidden());
            $task->setDefault('users_list', $this->getUser()->getId());
        } else {
            $task->setDefault('users_list', array($this->getUser()->getId()));
        }
        $task->setDefault('created_from', $this->getUser()->getId());
        $task->setDefault('updated_from', $this->getUser()->getId());
        $task->setDefault('updated_from', $this->getUser()->getId());

        $this->form = $task;
        $this->getUser()->setFlash('type', ($request->hasParameter('type') ? $request->getParameter('type') : 1));

    }

    public function executeCreate(sfWebRequest $request)
    {
        //$this->forward404Unless($this->getUser()->setFlash('jobid',);
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new TaskForm();
        $task = $this->processForm($request, $this->form, "Create");
        $type = $this->getUser()->getFlash('type');
        if ($type == 1) {
            $this->redirect('task/edit?id=' . $task->getId() . '&type=' . $type);
        } else {

            $this->redirect($this->getUser()->getAttribute('back'));
            //$this->redirect('job/show?id='.$task->getJobId());
        }


        //$this->setTemplate('edit');
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->back = $this->getUser()->getAttribute('back');
        $this->forward404Unless($this->task = Doctrine_Core::getTable('Task')->find(array($request->getParameter('id'))), sprintf('Object task does not exist (%s).', $request->getParameter('id')));


    }


    public function executeEdit(sfWebRequest $request)
    {


        $this->back = $this->getUser()->getAttribute('back');
        $this->forward404Unless($this->task = Doctrine_Core::getTable('Task')->find(array($request->getParameter('id'))), sprintf('Object task does not exist (%s).', $request->getParameter('id')));
        if (!$this->getUser()->hasPermission('admin') AND $this->task->getJob()->getJobStateId() == 2) {
            $this->redirect('task/show/?id=' . $this->task->getId());
        }
//	$this->back = $this->getUser()->getFlash('back');
//$this->job = Doctrine_Core::getTable('Job')->find($task->getJobId());
        //echo $this->getUser()->getFlash('job');
        $this->type = ($request->hasParameter('type') ? $request->getParameter('type') : $this->task->getTaskTypeId());
        $this->form = new TaskForm($this->task, array(
            'type' => $this->type,
        ));

        if (!$this->getUser()->hasPermission('Korrektur')) {
            //unset($this->form['correction_info'], $this->form['correction_time']);
			$this->form->setWidget('correction_info',new sfWidgetFormInputHidden());
			$this->form->setWidget('correction_time',new sfWidgetFormInputHidden());
			$this->form->getWidget('correction_time')->setHidden(true);
			$this->form->getWidget('correction_info')->setHidden(true);

        }
        if (!$this->getUser()->hasPermission('Zuweisen')) {
            $this->form->setWidget('users_list', new sfWidgetFormInputHidden());
            $this->form->setDefault('users_list', $this->getUser()->getId());
        } else {
            //$this->form->setDefault('users_list', array($this->getUser()->getId()));
        }
        if ($this->type != 0) $this->form->setDefault('scheduled', 0);
        $this->form->setDefault('updated_from', $this->getUser()->getId());
        //	$this->setTemplate('edit');
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));

        $this->forward404Unless($task = Doctrine_Core::getTable('Task')->find(array($request->getParameter('id'))), sprintf('Object task does not exist (%s).', $request->getParameter('id')));
        $this->form = new TaskForm($task);

        $task = $this->processForm($request, $this->form, "Update");

        //$this->changelog($task, "Update");


        $type = $this->getUser()->getFlash('type');
        if ($type == 1) {
            $this->redirect('task/edit?id=' . $task->getId() . '&type=' . $type);
        } else {
            $this->redirect($this->getUser()->getAttribute('back'));
        }
    }

    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();

        $this->forward404Unless($task = Doctrine_Core::getTable('Task')->find(array($request->getParameter('id'))), sprintf('Object task does not exist (%s).', $request->getParameter('id')));

        $job = $task->getJobId();

        $taskusers = Doctrine_Core::getTable('TaskUser')->createQuery('t')
            ->where('t.task_id =' . $task->getId())
            ->execute();
        foreach ($taskusers as $tu) {
            $tu->delete();
        }

        $tchange = $task->getChangelog();

        foreach ($tchange as $tc) {
            $tc->delete();
        }


        $entrytask = Doctrine_Core::getTable('Entry')->createQuery('t')
            ->where('t.task_id =' . $task->getId())
            ->execute();

        foreach ($entrytask as $et) {
            $et->delete();
        }

        $task->delete();
        if($job){
            $this->redirect('/job/' . $job);
        }else{

            if($this->getUser()->hasAttribute('back')){
                $this->redirect($this->getUser()->getAttribute('back'));
               }
            else{
                $this->redirect('/');
            }

        }



    }

    protected function processForm(sfWebRequest $request, sfForm $form, $action)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            return $form->save();
            //$this->changelog($task, $action);

            // $this->redirect('job/show/?id='.$task->getJob()->getId());
        }

    }

    protected function changelog(Task $task, $action)
    {
        $cl = new TaskChangeLog();
        $cl->setTask($task);
        $cl->setUserId($this->getUser()->getId());
        $text = " Anfart" . $task->approach * 0.15;
        $text .= " Pause:" . $task->getBreak() * 0.15;
        $text .= " Anfang:" . $task->getStart();
        $text .= " Ende: " . $task->getEnd();
        $text .= " Info: " . $task->getInfo();
        $text .= " Übrstunden; " . $task->getOvertime();
        $cl->setAction($action . ":" . $text);
        $cl->save();
    }


}
