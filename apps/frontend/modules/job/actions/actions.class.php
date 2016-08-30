<?php

/**
 * job actions.
 *
 * @package    workbook
 * @subpackage job
 * @author     Florian Engler
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class jobActions extends sfActions
{

    protected function getJobStateArray($type, $name, $query, $page = 1, $results = 20,$user)
    {
        // Creating pager object
        $output = array();
        //$pager = new Doctrine_Pager( $query,
        //				$page, // Current page of request
        //				$results // (Optional) Number of results per page. Default is 25
        //				);

        $pager = new sfDoctrinePager('Job', 20);
        $pager->setQuery($query);
        $pager->setPage($page);
        $pager->init();
        $output['pager'] = $pager;
        $output['type'] = $type;
        $output['name'] = $name;
        $output['user'] = $user;
        //$this->pager->init();
        //$output['jobs'] = $pager->getResults();
        //$output['pager'] = $pager;
        $output['url'] = 'job/table/?type=' . $type;
		
        return $output;

    }

    public function executeTable(sfWebRequest $request)
    {
        $job = new Job();
        switch ($request->getParameter('type')) {
            case '0':
                $query = Doctrine_Core::getTable('Job')->getOwnJobs($this->getUser()->getId());
                $name = 'Offen';
                break;
            case '1':
                $query = Doctrine_Core::getTable('Job')->getOpenJobs();
                $name = 'offen';
                break;
            case '2':
                if( $request->hasParameter('user')){
                    $query = Doctrine_Core::getTable('Job')->getSheduledJobsByUser($request->getParameter('user'));
                }else{
                    $query = Doctrine_Core::getTable('Job')->getSheduledJobs();
                }


                $name = 'geplant';
                break;
            case '3':
                $query = ($request->hasParameter('user') ?
                    Doctrine_Core::getTable('Job')->getWorkedJobsByUser($request->getParameter('user'))
                    : Doctrine_Core::getTable('Job')->getWorkedJobs());
                $name = 'in Bearbeitung';
                break;
            case '4':
                $query = Doctrine_Core::getTable('Job')->getFinishedJobs();
                $name = 'erledigt';
                break;
            case '5':
                $query = Doctrine_Core::getTable('Job')->getCompletedJobs();
                $name = 'Abgeschlossen';
                break;
        }
        $this->state = $this->getJobStateArray(
			$request->getParameter('type'),
			$name,
            $query,
			$request->getParameter('page'),
			$request->getParameter('max'),
			$request->getParameter('user')
		);

        $this->setTemplate('table');
        $this->setLayout(false);
    }

    public function executeIndex(sfWebRequest $request)
    {
        $this->jobstate = array();

        $this->jobs_own = array('name' => 'eigene Aufträge',
            'count' => Doctrine_Core::getTable('Job')->getCountOwnJobs($this->getUser()->getId()));
        $this->jobs_open = array('name' => 'offene Aufträge',
            'count' => Doctrine_Core::getTable('Job')->getCountOpenJobs());
        $this->job_worked = array('name' => 'in Bearbeitung',
            'count' => Doctrine_Core::getTable('Job')->getCountWorkedJobs());

        //  $this->jobs_sheduled_count =    Doctrine_Core::getTable('Job')->getCountSheduledJobs();

        $this->jobs_sheduled = array();
        $query = Doctrine_Query::create()
            ->select('u.id')
            ->from('sfGuardUser u')
            ->execute();

        foreach ($query as $user) {
            $this->jobs_sheduled[] = array('id' => $user->getID(),
                'name' => $user->getName(),
                'count' => Doctrine_Core::getTable('Job')->getCountSheduledJobsByUser($user->getID()));

        }


        if ($this->getUser()->hasPermission('Rechnung')) {
            $this->jobs_finisched = array('name' => 'abgeschlossene Aufträge',
                'count' => Doctrine_Core::getTable('Job')->getCountFinishedJobs());
        }

        $this->formStore = new searchStoreForm(NULL, array(
            'url' => $this->getController()->genUrl('job/findstore'),
        ));
        $this->formCustomer = new searchCustomerForm(NULL, array(
            'url' => $this->getController()->genUrl('job/findcustomer')
        ));
        $this->setBack('job');

    }

    public function executeFinish(sfWebRequest $request)
    {
        $this->forward404Unless($job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))), sprintf('Object job does not exist (%s).', $request->getParameter('id')));
        if ($job->getJobStateId() > 1) $job->setJobStateId(1);
        else $job->setJobStateId(2);

        $job->save();
        //$this->job = $job;
        $this->redirect('job/show/?id=' . $job->getId());

    }

    public function executeSearch(sfWebRequest $request)
    {
        //if(!$request->isMethod(sfRequest::get))  $this->redirect('job');
        //if($request->hasParameter('customer'))
        $this->parameters = '';
        $this->jobs = array();
        $query = Doctrine_Query::create()
            ->select('j.*')
            ->from('Job j');
        if ($request->hasParameter('store') && is_numeric($request->getParameter('store'))) {
            $query->where('j.store_id = ' . $request->getParameter('store'))
                ->orderby('j.end DESC');
            $this->parameters .= 'store='.$request->getParameter('store');
        }

        if ($request->hasParameter('customer') && is_numeric($request->getParameter('customer'))) {
            $t = Doctrine_Query::create()
                ->select('id')->from('Store s')
                ->where('customer_id = ' . $request->getParameter('customer'))->execute();
            $stores = array();
            foreach ($t as $s) {
                $stores[] = $s->getId();
            }
            $this->parameters .= 'customer='.$request->getParameter('customer');
                $query->where('j.store_id IN (' . implode(",", $stores) . ')')
                ->orderby('j.end DESC')
                ;
        }
        if ($request->hasParameter('page')){
            $this->page = $request->getParameter('page');
        }else{
            $this->page = 1;
        }


        $this->jobs =  $query->offset(($this->page*100)-100)->limit(100)->execute();
        $this->results = count($this->jobs);









    }

    public function executeArchiv(sfWebRequest $request)
    {
        $max = 25;
        if ($request->hasParameter('max')) $max = $request->getParameter('max');
        $this->pager = new sfDoctrinePager('Job', $max);
        $this->pager->setQuery(Doctrine_Query::create()
            ->select('j.*')
            ->from('Job j')
            ->where('j.job_state_id > 1')
            ->andWhere(' j.id IN (select job_id from job_invoice) ')
            ->orderby('j.end'));
        $this->pager->setPage($request->getParameter('page'));
        $this->pager->init();
        $this->formStore = new searchStoreForm(NULL, array(
            'url' => $this->getController()->genUrl('job/findstore'),
        ));
        $this->formCustomer = new searchCustomerForm(NULL, array(
            'url' => $this->getController()->genUrl('job/findcustomer')
        ));
        $this->url = 'job/archiv';
        $this->setBack('job');

    }


    public function executeShow(sfWebRequest $request)
    {
        $this->back = $this->getUser()->getAttribute('back');

        $this->forward404Unless($this->job =
            Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))));
        $this->create = Doctrine_Core::getTable('sfGuardUser')
            ->find($this->job->getCreatedFrom());
        $this->update = Doctrine_Core::getTable('sfGuardUser')
            ->find($this->job->getUpdatedFrom());

        $this->setBack('/job/show?id=' . $this->job->getId());

        $this->changelog = Doctrine_Core::getTable('JobChangeLog')->getLastChange($this->job->getId());

        $this->openjobs_near = Doctrine_Core::getTable('Job')->getSimilarOpenJobs($this->job->getStore()->getPostcode(), 10, $this->job->getId(), $this->job->getStore()->getId());
        $this->openjobs_same = Doctrine_Core::getTable('Job')->getStoreOpenJobs($this->job->getId(), $this->job->getStore()->getId());
        $this->jobsold = Doctrine_Core::getTable('Job')->getStoreOldJobs($this->job->getId(), $this->job->getStore()->getId());

        //$this->UserForm = new JobUserForm();
        // $this->UserForm->setDefault('job', $this->job->getId());


        $this->FileForm = new FileForm(NULL);
        //$this->form->setDefault('jobs_list', array($this->job->getId()));
        $this->entrys = Doctrine_Core::getTable('Entry')->getEntypByJob($this->job->getId());
        $this->date = array();
        $this->work = array();
        $this->worksumme = 0;
        $this->overtimesumme = 0;
        $part = Doctrine_Core::getTable('Option')->getOptionByName('payroll_hour_split');

        $tasks = Doctrine_Core::getTable('Task')
            ->createQuery('t')
            ->where('t.job_id = ?', $this->job->getId())
            ->orderBy('t.Start ASC')
            ->execute();

        foreach ($tasks as $task) {
            if (!$task->getScheduled()) {

                //$Stunden =  date('H',strtotime($task->getEnd())) - date('H',strtotime($task->getStart()))  - $task->getOvertime();
                //$Minuten = (date('i',strtotime($task->getEnd())) - date('i',strtotime($task->getStart())));

                $diff = date_diff(new DateTime($task->getStart()), new DateTime($task->getEnd()));
                $Stunden = $diff->format('%h') - $task->getOvertime();
                // Stunden Addierung wenn mehrere Tage gearbeitet wurde( kommt eingentlich nicht vor)
                if ($diff->format('%d') > 0) {
                    $Stunden += $diff->format('%d') * 24;
                }
                // Minuten Berechnung in Stunden anteile
                $Minuten = $diff->format('%i');
                $nettoMinuten =     $Minuten - ($task->getBreak() * 15);

                echo 'Netto '.$nettoMinuten;
                $Minuten = intval($nettoMinuten / $part) * $part;
                echo 'Brutto '.$Minuten;
                if($nettoMinuten > 1 AND $nettoMinuten % $part) {
                    $Minuten +=  $part;
                }
                echo 'Brutto2 '.$Minuten;
                               
               
                if ($Minuten != 0) $Stunden += round($Minuten / 60, 2);
                $this->worksumme += $Stunden + $task->getCorrectionTime();
                $this->overtimesumme += $task->getOvertime();
                $t = array('time' => $Stunden + $task->getCorrectionTime(), 'task' => $task);

                $this->work[] = $t;
            } else {
                $this->date[] = $task;
            }


        }


    }

    public function executeUser(sfWebRequest $request)
    {
        if (!$request->isMethod(sfRequest::POST)) $this->redirect($this->getUser()->getAttribute('back'));
        $job = $request->getParameter('job');
        $users = $request->getParameter('user');
        Doctrine_Core::getTable('JobUser')->deleteJobUser($job);
        foreach ($users as $user) {
            $JobUser = new JobUser();
            $JobUser->setJobId($job);
            $JobUser->setUserId($user);
            $JobUser->save();
        }
        $this->redirect('/job/' . $job);
    }


    public function executeNew(sfWebRequest $request)
    {

        $jobNew = null;

        if($request->isMethod(sfRequest::GET) and $request->hasParameter('job')){
            $jobOrg =  Doctrine_Core::getTable('Job')->find(array($request->getParameter('job')));

            $jobNew = new Job();
            $jobNew->setJobType($jobOrg->getJobType());
            $this->type = $jobOrg->getJobType()->getName();
            $jobNew->setContactPerson($jobOrg->getContactPerson());
            $jobNew->setContactInfo($jobOrg->getContactInfo());

            $jobNew->setDescription($jobOrg->getDescription());
            $this->customer = $jobOrg->getStore()->getCustomer();


            $dt = new DateTime(); //will be now
            $dt->modify('+1 days');
            $jobNew->setStart($dt->format('Y-m-d 08:00'));
            $jobNew->setEnd($dt->format('Y-m-d 16:00'));

        }elseif($request->isMethod(sfRequest::POST) ){

            $this->forward404Unless($request->getParameter('customer'));


            switch ($request->getParameter('type')) {
                case '1':
                    $this->type = 'Fix';
                    break;
                case '2':
                    $this->type = 'bis zum';
                    break;
                case '3':
                    $this->type = 'von bis';
                    break;
                case '4':
                    $this->type = 'Wartung';
                    break;
            }
            $this->customer = Doctrine_Core::getTable('Customer')->find(array($request->getParameter('customer')));

        }else{
            $this->redirect('job/prenew');
        }



        $this->form = new JobForm($jobNew, array(
            'url' => $this->getController()->genUrl('job/findstore/?customer=' .  $this->customer->getId()),
            'type' => $request->getParameter('type'),
            'customer' => $this->customer,
        ));
        $this->form->setDefault('created_from', $this->getUser()->getId());
        $this->form->setDefault('updated_from', $this->getUser()->getId());
    }

    public function executePrenew(sfWebRequest $request)
    {
        $this->form = new PreJobForm(NULL, array(
            'url' => $this->getController()->genUrl('job/findcustomer')
        ));
    }


    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new JobForm();

        $this->processForm($request, $this->form, "Create");

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))), sprintf('Object job does not exist (%s).', $request->getParameter('id')));

        $this->form = new JobForm($job, array(
            'url' => $this->getController()->genUrl('job/findstore'),
            'type' => $job->getJobTypeId(),
            'customer' => $job->getStore()->getCustomer()));
        //$this->form->setOption('updated_from',$this->getUser());
        $this->form->setDefault('updated_from', $this->getUser()->getId());
        $this->back = $this->getUser()->getAttribute('back');
    }


    public function executeWork(sfWebRequest $request)
    {
        $this->forward404Unless($job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))), sprintf('Object job does not exist (%s).', $request->getParameter('id')));

        $this->form = new JobForm($job, array('url' => $this->getController()->genUrl('job/ajax')));


    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))), sprintf('Object job does not exist (%s).', $request->getParameter('id')));
        $this->form = new JobForm($job);
        //$this->form->setOption('updated_from',$this->getUser()->getId());
        $this->processForm($request, $this->form, "Update");

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))), sprintf('Object job does not exist (%s).', $request->getParameter('id')));
        $job->delete();

        $this->redirect('job/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form, $action)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $job = $form->save();
            //$this->changelog($job, $action);
            $this->redirect('job/show/job/show?id=' . $job->getId());
        }
    }

    protected function changelog(Job $job, $action)
    {
        $cl = new JobChangeLog();
        $cl->setJob($job);
        $cl->setUserId($this->getUser()->getId());
        $cl->setAction($action);
        $cl->save();
    }


    public function executeFindstore($request)
    {
        $this->getResponse()->setContentType('application/json');

        $stores = store::retrieveForSelect($request->getParameter('q'),
            $request->getParameter('limit'), $request->getParameter('customer'));

        return $this->renderText(json_encode($stores));
    }

    public function executeFindcustomer($request)
    {
        $this->getResponse()->setContentType('application/json');

        $cutomers = customer::retrieveForSelect($request->getParameter('q'),
            $request->getParameter('limit'), $request->getParameter('customer'));

        return $this->renderText(json_encode($cutomers));
    }


    protected function setBack($var)
    {
        $routing = $this->getContext()->getRouting();
        $this->getUser()->setFlash('back', $var);
        $this->getUser()->setAttribute('back',$var);
    }

}
