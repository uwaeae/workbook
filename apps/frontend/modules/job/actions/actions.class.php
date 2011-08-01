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
  public function executeIndex(sfWebRequest $request)
  {
   // $this->jobs = Doctrine_Core::getTable('Job')
     // ->createQuery('j')
	//->leftJoin('j.Users u')
	 // ->where('u.id = ?',$this->getUser()->getId() )
     // ->execute();
	$this->jobstate = array();
	$this->jobstate[1]['type'] = 1;
	$this->jobstate[1]['Name']  = 'Offen';
	$this->jobstate[1]['jobs'] = Doctrine_Query::create()
				->select('j.*')
				->from('Job j')
				->where('j.id NOT IN (select job_id from task 
							where job_id IS NOT NULL
							AND scheduled IS NOT NULL
							GROUP BY job_id)')
				->orderby('j.end')
				->execute();
	if($this->getUser()->hasGroup('admin') 
					OR $this->getUser()->hasGroup('office')){
	$this->jobstate[2]['type'] = 2;
	$this->jobstate[2]['Name'] = 'Geplant';
	$this->jobstate[2]['jobs'] = Doctrine_Query::create()
			->select('j.*')
			->from('Job j')
			->where('j.id IN (select job_id from task 
					where job_id IS NOT NULL 
					AND scheduled IS TRUE 
					GROUP BY job_id)')
			->orderby('j.end')
			->execute();
	$this->jobstate[3]['type'] = 3;		
	$this->jobstate[3]['Name'] = 'in Bearbeitung';
	$this->jobstate[3]['jobs'] = Doctrine_Query::create()
			->select('j.*')
			->from('Job j')
			->where('j.id IN (select job_id from task 
							where job_id IS NOT NULL 
							AND scheduled IS NOT TRUE 
							GROUP BY job_id)')
			->andWhere('j.job_state_id = 1')
			->andWhere(' j.id NOT IN (select job_id from job_invoice) ')
			->orderby('j.end')
			->execute();
	}
    if ( $this->getUser()->hasPermission('Rechung')) {
	$this->jobstate[4]['type'] = 4;			
	$this->jobstate[4]['Name'] = 'Abgeschlossen'	;
	$this->jobstate[4]['jobs'] = Doctrine_Query::create()
			->select('j.*')
			->from('Job j')
			->where('j.job_state_id > 1')
			->andWhere(' j.id NOT IN (select job_id from job_invoice) ')
			->orderby('j.end')
			->execute();
			}
		$this->formStore = new searchStoreForm(NULL,array(
			'url' => $this->getController()->genUrl('job/findstore'),
				));
		$this->formCustomer = new searchCustomerForm(NULL,array(
			'url' => $this->getController()->genUrl('job/findcustomer')
			));
		$this->setBack('job');
			
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
	
	
	$this->jobs = Doctrine_Query::create()
			->select('j.*')
			->from('Job j')
			->where('j.job_state_id > 1')
			->andWhere(' j.id IN (select job_id from job_invoice) ')
			->orderby('j.end')
			->execute();
  }
  

  public function executeShow(sfWebRequest $request)
  {	
	$this->back = $this->getUser()->getAttribute('back');
	$this->forward404Unless($this->job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))));
		$this->setBack('job/show?id='.$request->getParameter('id'));
		$this->openjobs =  Doctrine_Query::create()
				->select('j.store_id s.id ')
				->from('Job j')
				->innerJoin('j.Store s WITH s.postcode between '.
				($this->job->getStore()->getPostcode() - 10).' and '.
				($this->job->getStore()->getPostcode() + 10))
				->where('j.job_state_id = 1')
				->orderby('j.end')
				->execute();
	$this->form = new FileForm(NULL);
	//$this->form->setDefault('jobs_list', array($this->job->getId()));


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

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))), sprintf('Object job does not exist (%s).', $request->getParameter('id')));

    $this->form = new JobForm($job, array('url' => $this->getController()->genUrl('job/ajax')));
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

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))), sprintf('Object job does not exist (%s).', $request->getParameter('id')));
    $job->delete();

    $this->redirect('job/index');
  }

protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $job = $form->save();

      $this->redirect('job/show/?id='.$job->getId());
    }
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
protected function makeFileForm( )
  {
    
  }




protected function setBack($var){
		$routing = $this->getContext()->getRouting();
		$this->getUser()->setFlash('back',$var);
		$this->getUser()->setAttribute('back',$routing->getCurrentInternalUri());
		}


}
