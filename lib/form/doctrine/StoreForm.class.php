<?php

/**
 * Store form.
 *
 * @package    workbook
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class StoreForm extends BaseStoreForm
{
  public function configure()
  {
	unset(
	      $this['created_at'], $this['updated_at']
		    );
		
		if ($this->getOption('customer')) {
			$this->setDefault('customer_id',  $this->getOption('customer'));
			$this->widgetSchema['customer_id']  = new sfWidgetFormInputHidden();
		}
		if ($this->getOption('hq') == 1) {
			$this->setDefault('number', 0);
			$this->widgetSchema['number']  = new sfWidgetFormInputHidden();
			}
			$this->widgetSchema['fon'] = new sfWidgetFormInput();
			$this->widgetSchema['fax'] = new sfWidgetFormInput();
		
		$this->widgetSchema->setLabels(array(
			'number'    => 'Filialnummer',
			'contact'      => 'Kontaktperson',
			'info'   => 'Informationen',
			'street'   => 'Strasse',
			'city'   => 'Stadt',
			'destrict'   => 'Bezirk',
			'country'   => 'Land',
			'fon'   => 'Telefon',
			'fax'   => 'Fax',
			'postcode'   => 'PLZ',
			'customer_id' => 'Kunde'
		));
	
  }
}
