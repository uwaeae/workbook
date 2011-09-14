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
					->where('u.user_id ='.$this->getUser()->getId())
					->andWhere('MONTH(t.start) = MONTH(NOW()) ')
					->execute();

	 foreach ($t as $task) {
	 	$tmp = array();
			$start = strtotime($task->getStart());
			$diff = date_diff(new DateTime($task->getStart()), new DateTime($task->getEnd()));
			if($diff->format('%d') > 0 ){
				$Stunden = 0;
				for($i = 1; $i < $diff->format('%d'); $i++)
				{
		   			$date = mktime(0, 0, 0, date("m",$start)  , date("d",$start)+ $i , date("Y",$start));	
					if(	date('w',$date) != 0 or date('w',$date) != 6)
					{
					$Stunden++;
					}
				}

				$Stunden = $Stunden * 8;

			}
			else {
				$Stunden =  date('H',strtotime($task->getEnd())) - date('H',strtotime($task->getStart()))  - $task->getOvertime();
			 	$Minuten = (date('i',strtotime($task->getEnd())) - date('i',strtotime($task->getStart())))	;
				if( 7 > $Minuten and $Minuten > -7  ) $Minuten  = 0; 
				if( -22 < $Minuten and $Minuten <= -8 ) $Minuten  = -15; 
				if( -37 < $Minuten and $Minuten <= -23 ) $Minuten  = -30; 
				if( -52 < $Minuten and $Minuten <= -38 ) $Minuten  = -45;
				if( $Minuten >= 53 ) $Minuten  = 0; 
				if( 22 > $Minuten and $Minuten >= 8 ) $Minuten  = 15; 
				if( 37 > $Minuten and $Minuten >= 23 ) $Minuten  = 30; 
				if( 52 > $Minuten and $Minuten >= 38 ) $Minuten  = 45; 

				if($Minuten != 0) $Stunden += $Minuten /60;
			}



			$this->overtime +=  $task->getOvertime();
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
	$task = new TaskForm(NULL,array(
	'type' => ($request->hasParameter('type')? $request->getParameter('type'): 1),	
		));
	//$this->job = null;
	if ($request->hasParameter('job')) {
		$this->job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('job')));
		$jobid = $this->job->getId();
		$this->tasks = Doctrine_Core::getTable('Task')->createQuery('t')
		  ->where('t.job_id ='.$jobid)
	      ->execute();
		$this->getUser()->setFlash('jobid',$this->job->getId());

		$task->setDefault('job_id', $jobid);
	}
		

	
	if (!$this->getUser()->hasPermission('Zuweisen')) {
			 $task->setWidget('users_list',new sfWidgetFormInputHidden());
			$task->setDefault('users_list', $this->getUser()->getId());
	}
	else{
	$task->setDefault('users_list', array($this->getUser()->getId()));
	}
	$task->setDefault('created_from',$this->getUser()->getId());
	$task->setDefault('updated_from',$this->getUser()->getId());

    $this->form = $task;

  }

  public function executeCreate(sfWebRequest $request)
  {
	//$this->forward404Unless($this->getUser()->setFlash('jobid',$this->getUser()->getFlash('jobid')));
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TaskForm();
    $this->processForm($request, $this->form,"Create");
	$this->setTemplate('edit');
  }

  public function executeEdit(sfWebRequest $request)
  {
	$this->back = $this->getUser()->getAttribute('back');
    $this->forward404Unless($task = Doctrine_Core::getTable('Task')->find(array($request->getParameter('id'))), sprintf('Object task does not exist (%s).', $request->getParameter('id')));
//	$this->back = $this->getUser()->getFlash('back');
//$this->job = Doctrine_Core::getTable('Job')->find($task->getJobId());
	//echo $this->getUser()->getFlash('job');
	
    $this->form = new TaskForm($task,array(
		'type' => ($request->hasParameter('type')? $request->getParameter('type'): $task->getTaskTypeId()),	
		));
	$this->form->setDefault('scheduled', 0);
	$this->form->setDefault('updated_from',$this->getUser()->getId());	
 	$this->setTemplate('new');
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));

    $this->forward404Unless($task = Doctrine_Core::getTable('Task')->find(array($request->getParameter('id'))), sprintf('Object task does not exist (%s).', $request->getParameter('id')));
    $this->form = new TaskForm($task);

    $this->processForm($request, $this->form,"Update");

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($task = Doctrine_Core::getTable('Task')->find(array($request->getParameter('id'))), sprintf('Object task does not exist (%s).', $request->getParameter('id')));
    
	$taskusers = Doctrine_Core::getTable('TaskUser')->createQuery('t')
	  ->where('t.task_id ='.$task->getId())
      ->execute();
	foreach ($taskusers as $tu) {
		$tu->delete();
	}
	/*$changelog = Doctrine_Core::getTable('TaskChangeLog')->createQuery('t')
	  ->where('t.task_id ='.$task->getId())
      ->execute();*/
	$task->delete();

    $this->redirect($this->getUser()->getAttribute('back'));
  }

  protected function processForm(sfWebRequest $request, sfForm $form,$action)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $task = $form->save();
	//$this->changelog($task, $action);
	  $this->redirect($this->getUser()->getAttribute('back'));
    // $this->redirect('job/show/?id='.$task->getJob()->getId());
    }
	 
  }
protected function changelog(Task $task,$action )
	{
		$cl = new TaskChangeLog();
		$cl->setTask($task);
		$cl->setUserId($this->getUser()->getId());
		$cl->setAction($action);
		$cl->save();
	}
 


}
