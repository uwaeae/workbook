<?php
class searchCustomerForm extends sfForm
{
  public function configure()
  {


	$this->setWidgets(array(
		 'customer'   => new sfWidgetFormDoctrineChoice(array('model' => 'Customer', 'add_empty' => false)),
		));
 	
	
	$this->widgetSchema['customer']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
	$this->widgetSchema['customer']->setOption('renderer_options', array(
		'model' => 'Customer',
		'url'   => $this->getOption('url'),
		'config'=>'{ width: 500,max: 100,highlight:false ,scroll: true,scrollHeight: 300}'	));
		
    $this->setValidators(array(
    ));
	$this->widgetSchema->setLabels(array(
	  'customer'    => 'Kunde',
	));
  }
}

?>