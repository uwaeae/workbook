<?php

require_once dirname(__FILE__).'/../lib/customerGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/customerGeneratorHelper.class.php';

/**
 * customer actions.
 *
 * @package    workbook
 * @subpackage customer
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class customerActions extends autoCustomerActions
{
	
	public function executeAddStore($request)
	{
		$store = new Store();
		$store->setCustomerID($request->getParameter('id'));
		$store->save();
		
		$this->redirect('store_edit',$store);
		
	}
	
}
