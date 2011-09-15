<?php
class PreJobForm extends sfForm
{
  public function configure()
  {
	$subForm = new sfForm();
	$form = new EntryFrom();
	$subForm->embedForm($i, $form);
	  
	$this->embedForm('Entry', $subForm);


    $this->setWidgets(array());
	
	$this->widgetSchema->setLabels(array(
	  'customer'    => 'Kunde',
	  'type'      => 'Auftragsart',
	  
	));
  }
}
?>