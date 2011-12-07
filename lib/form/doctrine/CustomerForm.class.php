<?php

/**
 * Customer form.
 *
 * @package    workbook
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CustomerForm extends BaseCustomerForm
{
  public function configure()
  {
	unset(
			$this['headoffice']
				 );
	//	$this->widgetSchema['end'] = new sfWidgetFormInput();
	//	$this->widgetSchema['start'] = new sfWidgetFormInput();
	$this->widgetSchema->setLabels(array(
	  'company'    => 'Firma / Name',
	  'logo'      => 'Logo',
	  'url'   => 'Link',
	  'number'   => 'Kundennummer',
	));
	
	
	
  }
}
