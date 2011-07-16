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
  public function executeFinish(sfWebRequest $request)
 	{
 $this->forward404Unless($job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))), sprintf('Object job does not exist (%s).', $request->getParameter('id')));
	if ($job->getJobStateId() > 1) 	$job->setJobStateId(1);
	else $job->setJobStateId(2);

	$job->save();
	$this->job = $job;
	$this->setTemplate('show');
	
	}

  public function executeShow(sfWebRequest $request)
  {
	  
    $this->forward404Unless($this->job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))));
		$this->setBack('job/show?id='.$request->getParameter('id'));

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
	'url' => $this->getController()->genUrl('job/ajax/?customer='.$request->getParameter('customer')),
	'type' => $request->getParameter('type'),
	'customer' => $request->getParameter('customer'),	
		));
 }

  public function executePrenew(sfWebRequest $request)
  {
    $this->form = new PreJobForm(NULL);
  }



 public function executeRandom(sfWebRequest $request)
  {
	$job = new Job();

	$job->setContactPerson('Herr Müller')  ;
	$job->setContactInfo('im Buero zu Erreichen')   ;
	$job->setJobTypeId(rand ( 1 ,  4 ))    ;
	$day = rand ( 1 ,  20 );
	$month = rand ( 0 , 2 );
	$job->setEnd(date('c',mktime(0,0,0,date("m")+$month ,date("d")+$day,date("Y"))))         ;
	$job->setStart(date('c',mktime(0,0,0,date("m")+$month ,date("d") +$day -1,date("Y"))))         ;
	$job->setDescription('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.')    ;
	$job->setTimeinterval(0)  ;
	$job->setJobStateId(1)    ;
	$job-> setStoreId(rand ( 1 ,  30 ))       ;
	
		 $job->save();
	
	
  $this->redirect('job/index');
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


public function executeAjax($request)
{
  $this->getResponse()->setContentType('application/json');

  $stores = store::retrieveForSelect($request->getParameter('q'), $request->getParameter('limit'),$request->getParameter('customer'));

  return $this->renderText(json_encode($stores));
}



 public function saveEmbeddedForms($con = null, $forms = null)
{
  	
  if (null === $forms)
  {
    $files = $this->getValue('newFiles');
    $forms = $this->embeddedForms;
    //echo var_dump($files);
    foreach ($this->embeddedForms['newFiles'] as $name => $form)
    {
	echo var_dump($files[$name]);
      if (!isset($files[$name]) || strlen($files[$name]) == 0)
      {
        unset($forms['newFiles'][$name]);
      }
    }
  }

  return parent::saveEmbeddedForms($con, $forms);
} 
protected function setBack($var){
		$routing = $this->getContext()->getRouting();
		$this->getUser()->setFlash('back',$var);
		$this->getUser()->setAttribute('back',$routing->getCurrentInternalUri());
		}


}
