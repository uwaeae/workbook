<?php

require_once dirname(__FILE__).'/../lib/invoiceGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/invoiceGeneratorHelper.class.php';

/**
 * invoice actions.
 *
 * @package    workbook
 * @subpackage invoice
 * @author     Florian Engler
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class invoiceActions extends autoInvoiceActions
{
	public function executeDelete(sfWebRequest $request) {
		$request->checkCSRFProtection();

		$this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

		$invoice = $this->getRoute()->getObject();



		$JobInvoices = Doctrine_Core::getTable('JobInvoice')->createQuery('j')
			->where('j.invoice_id ='.$invoice->getId())
			->execute();
		foreach($JobInvoices as $js){
			$js->delete();
		}


		if ($this->getRoute()->getObject()->delete())
		{
			$this->getUser()->setFlash('notice', 'The Invoice '.$invoice->getNumber().' was deleted successfully.');
		}

		$this->redirect('@invoice');
	}

}
