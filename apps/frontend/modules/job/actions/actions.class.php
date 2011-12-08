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

	protected function getJobStateArray($type,$name,$query,$page = 1,$results = 10)
	  {
		// Creating pager object
		$output = array();
		//$pager = new Doctrine_Pager( $query,
		//				$page, // Current page of request
		//				$results // (Optional) Number of results per page. Default is 25
		//				);
		
		$pager = new sfDoctrinePager('Job', 10);	
		$pager->setQuery($query);
		$pager->setPage($page);
		$pager->init();	
		$output['pager'] = $pager;			
		$output['type'] = $type;
		$output['name'] = $name;
		//$this->pager->init();
		//$output['jobs'] = $pager->getResults();
		//$output['pager'] = $pager;
		$output['url']  = 'job/table/?type='.$type;
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
			$name = 'offen'	;
			break;
		case '2':
			$query = Doctrine_Core::getTable('Job')->getSheduledJobs();
			$name = 'geplant';	
			break;
		case '3':
			$query = Doctrine_Core::getTable('Job')->getWorkedJobs();
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
 	$this->state = $this->getJobStateArray($request->getParameter('type'),'Offen'
									,
									$query
									,$request->getParameter('page')
									,$request->getParameter('max'));

 	$this->setTemplate('table');								
	$this->setLayout(false);						
	}
	
  public function executeIndex(sfWebRequest $request)
  {
	$this->setBack('job/index');	
   // $this->jobs = Doctrine_Core::getTable('Job')
     // ->createQuery('j')
	//->leftJoin('j.Users u')
	 // ->where('u.id = ?',$this->getUser()->getId() )
     // ->execute();
	$this->jobstate = array();
	$job = new Job();
	$this->jobstate[0] = $this->getJobStateArray(0,'meine Aufträge'
									,Doctrine_Core::getTable('Job')->getOwnJobs($this->getUser()->getId())
									,$request->getParameter('page')
									,$request->getParameter('max'));
	

	$this->jobstate[1] = $this->getJobStateArray(1,'offene Aufträge '
									,Doctrine_Core::getTable('Job')->getOpenJobs()
									,$request->getParameter('page')
									,$request->getParameter('max'));
								
	
//	if(	$this->getUser()->hasGroup('admin') 
//		OR $this->getUser()->hasGroup('office')){
						$this->jobstate[2] = $this->getJobStateArray(2,'geplante Aufträge'
													,Doctrine_Core::getTable('Job')->getSheduledJobs()
													,$request->getParameter('page')
													,$request->getParameter('max'));
						$this->jobstate[3] 	= $this->getJobStateArray(3,'in Bearbeitung'
										,$job->getWorkedJobs()
										,$request->getParameter('page')
										,$request->getParameter('max'));
//					}
	 if ( $this->getUser()->hasPermission('Rechnung')) {

	$this->jobstate[4] = $this->getJobStateArray(4,'abgeschlossene Aufträge'
								,Doctrine_Core::getTable('Job')->getFinishedJobs()
								,$request->getParameter('page')
								,$request->getParameter('max'));}				
	
			
		$this->formStore = new searchStoreForm(NULL,array(
			'url' => $this->getController()->genUrl('job/findstore'),
				));
		$this->formCustomer = new searchCustomerForm(NULL,array(
			'url' => $this->getController()->genUrl('job/findcustomer')
			));
		$this->setBack('job');
			
  }

 public function executeFinish(sfWebRequest $request)
  {
 $this->forward404Unless($job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))), 		sprintf('Object job does not exist (%s).', $request->getParameter('id')));
	if ($job->getJobStateId() > 1) $job->setJobStateId(1);
	else $job->setJobStateId(2);

	$job->save();
	//$this->job = $job;
    $this->redirect('job/show/?id='.$job->getId());

}
 
 public function executeSearch(sfWebRequest $request)
  {
	//if(!$request->isMethod(sfRequest::get))  $this->redirect('job');
	//if($request->hasParameter('customer'))
	$this->jobs = array();
	$query = Doctrine_Query::create()
			->select('j.*')
			->from('Job j');
	if($request->hasParameter('store') && is_numeric($request->getParameter('store'))) {
		$this->jobs = $query->where('j.store_id = '.$request->getParameter('store'))
			->orderby('j.end')
			->execute();
		}
	
	if($request->hasParameter('customer') && is_numeric($request->getParameter('customer'))){
		$t = Doctrine_Query::create()
					->select('id')->from('Store s')
					->where('customer_id = '.$request->getParameter('customer'))->execute();
		$stores = array();
		foreach ( $t as $s) {
					$stores[] = $s->getId();
				}
		 $this->jobs = $query->where('j.store_id IN ('.implode(",", $stores).')')
						->orderby('j.end')
						->execute();
				}
		$this->results = count($this->jobs);
  }
 public function executeArchiv(sfWebRequest $request)
  {
		$max = 25;
		if($request->hasParameter('max')) $max = $request->getParameter('max');
		$this->pager = new sfDoctrinePager('Job',$max );	
		$this->pager->setQuery( Doctrine_Query::create()
				->select('j.*')
				->from('Job j')
				->where('j.job_state_id > 1')
				->andWhere(' j.id IN (select job_id from job_invoice) ')
				->orderby('j.end'));
		$this->pager->setPage($request->getParameter('page'));
		$this->pager->init();
			$this->formStore = new searchStoreForm(NULL,array(
				'url' => $this->getController()->genUrl('job/findstore'),
					));
			$this->formCustomer = new searchCustomerForm(NULL,array(
				'url' => $this->getController()->genUrl('job/findcustomer')
				));
			$this->setBack('job');
		
  }
  

  public function executeShow(sfWebRequest $request)
  {	
	$this->back = $this->getUser()->getAttribute('back');
	$this->forward404Unless($this->job = 
		Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))));
	$this->create  = Doctrine_Core::getTable('sfGuardUser')
					->find($this->job->getCreatedFrom() );
	$this->update  = 			Doctrine_Core::getTable('sfGuardUser')
								->find($this->job->getUpdatedFrom() );
		

	$this->changelog = Doctrine_Core::getTable('JobChangeLog')->getLastChange($this->job->getId());
	
	$this->openjobs_near = Doctrine_Core::getTable('Job')->getSimilarOpenJobs($this->job->getStore()->getPostcode() ,10,$this->job->getId(),$this->job->getStore()->getId());
	$this->openjobs_same = Doctrine_Core::getTable('Job')->getStoreOpenJobs($this->job->getId(),$this->job->getStore()->getId());
	$this->jobsold = Doctrine_Core::getTable('Job')->getStoreOldJobs($this->job->getId(),$this->job->getStore()->getId());
	
	
	$this->form = new FileForm(NULL);
	//$this->form->setDefault('jobs_list', array($this->job->getId()));
    $this->entrys  = Doctrine_Core::getTable('Entry')->getEntypByJob($this->job->getId());
	$this->date = array();
	$this->work = array();
	$this->worksumme = 0;
	$part = Doctrine_Core::getTable('Option')->getOptionByName('payroll_hour_split');
	foreach ($this->job->getTasks() as $task) {
		if(!$task->getScheduled()){
			
			$Stunden =  date('H',strtotime($task->getEnd())) - date('H',strtotime($task->getStart()))  - $task->getOvertime();
		 	$Minuten = (date('i',strtotime($task->getEnd())) - date('i',strtotime($task->getStart())));
			$Minuten = round(($Minuten - ($task->getBreak()*15)) / $part, 0) * $part;
			if($Minuten != 0) $Stunden += round($Minuten / 60,2);
			$this->worksumme += $Stunden;
			$t = array('time' => $Stunden, 'task'=> $task);
			
			$this->work[] = $t;
		}
		else{
			$this->date[] = $task;
		}
		$this->setBack('job/show?id='.$request->getParameter('id'));	
		
	}


  }

 public function executeNew(sfWebRequest $request)
  {
	if(!$request->isMethod(sfRequest::POST))  $this->redirect('job/prenew');
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
	
    $this->form = new JobForm(NULL,array(
	'url' => $this->getController()->genUrl('job/findstore/?customer='.$this->customer->getId()),
	'type' => $request->getParameter('type'),
	'customer' => $request->getParameter('customer'),	
		));
 	$this->form->setDefault('created_from',$this->getUser()->getId());
	$this->form->setDefault('updated_from',$this->getUser()->getId());
}

  public function executePrenew(sfWebRequest $request)
  {
    $this->form = new PreJobForm(NULL,array(
			'url' => $this->getController()->genUrl('job/findcustomer')
			));
  }



 

 public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new JobForm();

    $this->processForm($request, $this->form,"Create");

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))), sprintf('Object job does not exist (%s).', $request->getParameter('id')));

    $this->form = new JobForm($job,array(
	'url' => $this->getController()->genUrl('job/findstore'),
	'type' => $job->getJobTypeId(),
	'customer' => $job->getStore()->getCustomer()));
	//$this->form->setOption('updated_from',$this->getUser());
	$this->form->setDefault('updated_from',$this->getUser()->getId());
	$this->back = $this->getUser()->getAttribute('back');	
  }


 public function executeWork(sfWebRequest $request)
  {
    $this->forward404Unless($job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))), 			   sprintf('Object job does not exist (%s).', $request->getParameter('id')));

    $this->form = new JobForm($job, array('url' => $this->getController()->genUrl('job/ajax')));
 
	
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))), sprintf('Object job does not exist (%s).', $request->getParameter('id')));
    $this->form = new JobForm($job);
	//$this->form->setOption('updated_from',$this->getUser()->getId());
    $this->processForm($request, $this->form,"Update");

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))), sprintf('Object job does not exist (%s).', $request->getParameter('id')));
    $job->delete();

    $this->redirect('job/index');
  }

protected function processForm(sfWebRequest $request, sfForm $form,$action)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $job = $form->save();
	//$this->changelog($job, $action);
      $this->redirect('job/show/?id='.$job->getId());
    }
  }
protected function changelog(Job $job,$action )
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
	$request->getParameter('limit'),$request->getParameter('customer'));

  return $this->renderText(json_encode($stores));
}

public function executeFindcustomer($request)
{
  $this->getResponse()->setContentType('application/json');

  $cutomers = customer::retrieveForSelect($request->getParameter('q'),
$request->getParameter('limit'),$request->getParameter('customer'));

  return $this->renderText(json_encode($cutomers));
}




protected function setBack($var){
		$routing = $this->getContext()->getRouting();
		$this->getUser()->setFlash('back',$var);
		$this->getUser()->setAttribute('back',$routing->getCurrentInternalUri());
		}


}
