<?php
class PreJobForm extends sfForm
{
  public function configure()
  {
	$customers = Doctrine_Query::create()
		    ->from('Customer')->execute();
	$jobtype = Doctrine_Query::create()
			 ->from('JobType')->execute();
    $this->setWidgets(array(
      	'customer' => new sfWidgetFormDoctrineChoice(array('model' => 'Customer', 'multiple' => false, )),
		'type' => new sfWidgetFormDoctrineChoice(array('model' => 'JobType', 'multiple' => false, )),
    ));
	  $this->setDefault('type', 2 );
	  if($this->getOption('customer') == NULL){

	$this->widgetSchema['customer']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
	$this->widgetSchema['customer']->setOption('renderer_options', array(
		'model' => 'Customer',
		'url'   => $this->getOption('url'),
		'config'=>'{ width: 500,max: 100,highlight:false ,scroll: true,scrollHeight: 300}'	));
	}else
	{
		$this->widgetSchema['customer'] = new sfWidgetFormInputHidden();
		$this->setDefault('customer', $this->getOption('customer') );		
	}
 	
    $this->setValidators(array(
    ));
	$this->widgetSchema->setLabels(array(
	  'customer'    => 'Kunde',
	  'type'      => 'Auftragsart',
	  
	));
  }
}
// sfWidgetFormChoice(array('choices' => $customers)),
?>