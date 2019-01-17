<?php

/**
 * invoice actions.
 *
 * @package    workbook
 * @subpackage invoice
 * @author     Florian Engler
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class invoiceActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->invoices = Doctrine_Core::getTable('Invoice')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {


    $this->form = new InvoiceForm();
  	$this->job = NULL;
	
	if($request->hasParameter('job')){
		$this->forward404Unless($this->job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('job'))),
		sprintf('Dieser Auftragsnummer existiert nicht (%s).', $request->getParameter('job')));	
		$job_id = $request->getParameter('job'); 
		$this->form->setDefault('jobs_list', $job_id);
		$this->form->setOption('jobs_list',array('disabled' => 'true', 'readonly'=>'readonly'));
		$this->form->setWidget('jobs_list', new sfWidgetFormInputHidden());
	}
	  if($this->getUser()->getAttribute('back')){
		  $this->back = $this->getUser()->getAttribute('back');
	  }
	  else{
		  $this->back = '/';
	  }

  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new InvoiceForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
	  $this->job = NULL;
    $this->forward404Unless($invoice = Doctrine_Core::getTable('Invoice')->find(array($request->getParameter('id'))), sprintf('Object invoice does not exist (%s).', $request->getParameter('id')));


    $jobs = Doctrine::getTable('Job')
          ->createQuery('j')
          ->innerJoin('j.Invoices ji')
          ->innerJoin('j.Store s')
          ->where('ji.id = ?', $invoice->getId())
          ->execute();

    $this->jobs = $jobs;
    $this->form = new InvoiceForm($invoice);
	  if($this->getUser()->getAttribute('back')){
		  $this->back = $this->getUser()->getAttribute('back');
	  }
	  else{
		  $this->back = '/';
	  }



  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($invoice = Doctrine_Core::getTable('Invoice')->find(array($request->getParameter('id'))), sprintf('Object invoice does not exist (%s).', $request->getParameter('id')));
    $this->form = new InvoiceForm($invoice);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($invoice = Doctrine_Core::getTable('Invoice')->find(array($request->getParameter('id'))), sprintf('Object invoice does not exist (%s).', $request->getParameter('id')));
    Doctrine_Query::create()
			->delete('JobInvoice j')
			->where('j.invoice_id ='.$invoice->getId())
			->execute();
	$invoice->delete();

    if($this->getUser()->getAttribute('back')){
      $this->redirect($this->getUser()->getAttribute('back'));
    }
    else{
      $this->redirect('/');
    }


    //$this->redirect('/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $invoice = $form->save();

      $this->redirect('/invoice/edit?id='.$invoice->getId());
    }
  }
}
