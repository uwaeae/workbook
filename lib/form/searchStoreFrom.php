<?php
class searchStoreForm extends sfForm
{
  public function configure()
  {
	$this->setWidgets(array(
		'store'   => new sfWidgetFormDoctrineChoice(array('model' => 'Store', 'add_empty' => false)),
		));

	$this->widgetSchema['store']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
	$this->widgetSchema['store']->setOption('renderer_options', array(
		'model' => 'Store',
		'url'   => $this->getOption('url'),
		'config'=>'{ width: 500,max: 100,highlight:false ,scroll: true,scrollHeight: 300}'	));
	


    $this->setValidators(array(
    ));
	$this->widgetSchema->setLabels(array(
	  'store'      => 'Adresse',
	  
	));
  }
}

?>