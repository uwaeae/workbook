<?php

/**
 * customer actions.
 *
 * @package    workbook
 * @subpackage customer
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class customerActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
  
		$this->pager = new sfDoctrinePager('Customer', ($request->hasParameter('max')? $request->getParameter('max'): 100));	
		$query = Doctrine_Core::getTable('Customer')
	      ->createQuery('c');
		if ($request->hasParameter('sort')) {
			 $query->orderBy('c.'.$request->getParameter('sort'));
		}else{
			$query->orderBy('c.company');
		}
		
		$this->pager->setQuery($query);
		$this->pager->setPage($request->getParameter('page'));
		$this->pager->init();
		
			$this->formStore = new searchStoreForm(NULL,array(
				'url' => $this->getController()->genUrl('customer/findstore'),
					));
			$this->formCustomer = new searchCustomerForm(NULL,array(
				'url' => $this->getController()->genUrl('customer/findcustomer')
				));


  }

  public function executeShow(sfWebRequest $request)
  {
    $this->customer = Doctrine_Core::getTable('Customer')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->customer);
	$this->form = new PreJobForm(NULL,array(
		'customer' => $this->customer->getID()
		));
	
}

  public function executeNew(sfWebRequest $request)
  {
	if($this->getUser()->hasPermission('Kunden')) $this->form = new CustomerForm();
	else { 
		$this->getResponse()->setContent("<html><body>Funktionn nicht verfügbar</body></html>");
		return sfView::ERROR; 
		}
  }

 public function executeSearch(sfWebRequest $request)
  {
	//if(!$request->isMethod(sfRequest::get))  $this->redirect('job');
	//if($request->hasParameter('customer'))
	
	if($request->hasParameter('store') && is_numeric($request->getParameter('store'))) {
		$store = Doctrine_Core::getTable('store')->find(array($request->getParameter('store')));
		$this->redirect('customer/show?id='.$store->getCustomerID());
		}

	if($request->hasParameter('customer') && is_numeric($request->getParameter('customer'))){
		$this->redirect('customer/show?id='.$request->getParameter('customer'));
		}
		
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $form = new CustomerForm();

    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $customer = $form->save();
	  $this->redirect('store/new?customer='.$customer->getID().'&hq=1');
    }
	$this->form = $form;
	$this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($customer = Doctrine_Core::getTable('Customer')->find(array($request->getParameter('id'))), sprintf('Object customer does not exist (%s).', $request->getParameter('id')));
    $this->form = new CustomerForm($customer);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($customer = Doctrine_Core::getTable('Customer')->find(array($request->getParameter('id'))), sprintf('Object customer does not exist (%s).', $request->getParameter('id')));
    $this->form = new CustomerForm($customer);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($customer = Doctrine_Core::getTable('Customer')->find(array($request->getParameter('id'))), sprintf('Object customer does not exist (%s).', $request->getParameter('id')));
    $customer->delete();

    $this->redirect('customer/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $customer = $form->save();

     
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
	
}
