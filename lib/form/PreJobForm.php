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