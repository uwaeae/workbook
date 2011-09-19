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
  
		$this->pager = new sfDoctrinePager('Customer', ($request->hasParameter('max')? $request->getParameter('max'): 30));	
		$this->pager->setQuery(Doctrine_Core::getTable('Customer')
	      ->createQuery('c')
		  ->orderBy('c.company'));
		$this->pager->setPage($request->getParameter('page'));
		$this->pager->init();


  }

  public function executeShow(sfWebRequest $request)
  {
    $this->customer = Doctrine_Core::getTable('Customer')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->customer);
  }

  public function executeNew(sfWebRequest $request)
  {
	if($this->getUser()->hasPermission('Kunden')) $this->form = new CustomerForm();
	else { 
		$this->getResponse()->setContent("<html><body>Funktionn nicht verfügbar</body></html>");
		return sfView::ERROR; 
		}
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CustomerForm();

    $this->processForm($request, $this->form);

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

      $this->redirect('customer/edit?id='.$customer->getId());
    }
  }
}
