<?php

/**
 * Entry form.
 *
 * @package    workbook
 * @subpackage form
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EntryForm extends BaseEntryForm
{
  public function configure()
  {
	//$this->widgetSchema['description'] = new sfWidgetForm();
	$this->widgetSchema['amount'] = new sfWidgetFormInput();
	$this->widgetSchema['item_id']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
	$this->widgetSchema['item_id']->setOption('renderer_options', array(
		'model' => 'Item',
		'url'   => $this->getOption('url'),
		'config'=>'{ width: 500,max: 100,highlight:false ,scroll: true,scrollHeight: 300}'	));
	//$this->widgetSchema['item_id'] = new sfWidgetFormDoctrineJQueryAjax();	
	
	$this->widgetSchema['description'] = new sfWidgetFormInputText();
	
	
	$this->widgetSchema['job_id'] = new sfWidgetFormInputHidden();
	$this->setDefault('amount', 1 );
	$this->widgetSchema->setLabels(array(
		'description'    => 'Beschreibung',
		'amount' => 'Stück',
		'item_id' => 'Artikel'
	
	));
	
  }
}
