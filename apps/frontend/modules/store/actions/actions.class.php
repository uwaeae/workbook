<?php

/**
 * store actions.
 *
 * @package    workbook
 * @subpackage store
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class storeActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->stores = Doctrine_Core::getTable('Store')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->store = Doctrine_Core::getTable('Store')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->store);
  }

  public function executeNew(sfWebRequest $request)
  {
	 $options = array();
	if ($request->hasParameter('customer')) {
	$this->forward404Unless(
		 $this->customer = Doctrine_Core::getTable('Customer')->find(array($request->getParameter('customer'))), sprintf('Angegebener Kunde existiert nicht ID (%s).', $request->getParameter('customer')));
		$options['customer'] = $this->customer->getID();
	}
	if ($request->hasParameter('hq')) {
		$options['hq'] = $request->getParameter('hq');
	}
		
	$this->form = new StoreForm(NULL,$options);
	
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new StoreForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($store = Doctrine_Core::getTable('Store')->find(array($request->getParameter('id'))), sprintf('Object store does not exist (%s).', $request->getParameter('id')));
    $this->form = new StoreForm($store);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($store = Doctrine_Core::getTable('Store')->find(array($request->getParameter('id'))), sprintf('Object store does not exist (%s).', $request->getParameter('id')));
    $this->form = new StoreForm($store);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($store = Doctrine_Core::getTable('Store')->find(array($request->getParameter('id'))), sprintf('Object store does not exist (%s).', $request->getParameter('id')));
    $cid = $store->getCustomerID();
	$store->delete();

    $this->redirect('/customer/show?id='.$cid);
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $store = $form->save();
		if($store->getNumber() == 0){
			$customer = $store->getCustomer();
			$customer->setHeadoffice($store->getID());
			$customer->save();
		}
      $this->redirect('/customer/show?id='.$store->getCustomerID());
    }
  }
}
