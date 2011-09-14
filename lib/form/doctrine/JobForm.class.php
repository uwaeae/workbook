<?php

/**
 * Job form.
 *
 * @package    workbook
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class JobForm extends BaseJobForm
{
  public function configure()
  {
	unset(
			$this['created_at'], $this['updated_at']
				 );

		
			$this->widgetSchema['end'] =  new sfWidgetFormJQueryDate(array( 'image' => '/images/icons/calendar.png','config' => '{}',));
				$this->widgetSchema['start'] =  new sfWidgetFormJQueryDate(array( 'image' => '/images/icons/calendar.png','config' => '{}',));
	
	switch ($this->getOption('type')) {
		case 1:
			unset(
			$this['timeinterval']
					 );
			$this->widgetSchema['job_state_id'] = new sfWidgetFormInputHidden();
			$this->widgetSchema['job_type_id'] = new sfWidgetFormInputHidden();
	
			$this->setDefault('end', date('c',mktime(16,0,0,date("m"),date("d")+1,date("Y"))));
			$this->setDefault('start', date('c',mktime(8,0,0,date("m"),date("d")+1,date("Y"))));
			$this->setDefault('job_type_id',  $this->getOption('type'));
			$this->setDefault('job_state_id',  1);
			break;
		case 2:
			unset(
			     $this['timeinterval']
				 );
			$this->widgetSchema['job_state_id'] = new sfWidgetFormInputHidden();
			$this->widgetSchema['job_type_id'] = new sfWidgetFormInputHidden();
			
			$this->setDefault('end', date('c',mktime(16,0,0,date("m"),date("d")+1,date("Y"))));
			$this->setDefault('start', date('c'));
			$this->setDefault('job_type_id',  $this->getOption('type'));
			$this->setDefault('job_state_id',  1);
			break;
		case 3:
			unset(
			     $this['timeinterval']
				 );
			$this->widgetSchema['job_type_id'] = new sfWidgetFormInputHidden();
			$this->widgetSchema['job_state_id'] = new sfWidgetFormInputHidden();
		
			$this->setDefault('end', date('c',mktime(0,0,0,date("m"),date("d")+1,date("Y"))));
			$this->setDefault('start', date('c',mktime(0,0,0,date("m"),date("d")+1,date("Y"))));
			$this->setDefault('job_type_id',  $this->getOption('type'));
			$this->setDefault('job_state_id',  1);
			break;
		case 4:
			unset(
			      $this['created_at'], $this['updated_at']
				 );
			$this->widgetSchema['job_state_id'] = new sfWidgetFormInputHidden();
			$this->widgetSchema['job_type_id'] = new sfWidgetFormInputHidden();
			$this->widgetSchema['timeinterval'] = new sfWidgetFormChoice(array('choices' => array('Einmalig','Wöchtenlich', 'Monatlich', 'Jährlich')));	
			$this->setDefault('job_type_id',  $this->getOption('type'));
			$this->setDefault('job_state_id',  1);
			break;
		default :
				$this->widgetSchema['job_type_id'] = new sfWidgetFormInputHidden();
				$this->widgetSchema['timeinterval'] = new sfWidgetFormChoice(array('choices' => array('Einmalig','Wöchtenlich', 'Monatlich', 'Jährlich')));	
				
				break;	
		
	}	
		
	$this->widgetSchema['description'] = new sfWidgetFormTextarea();
	$this->widgetSchema['contact_person'] = new sfWidgetFormInput();
	$this->widgetSchema['contact_info'] = new sfWidgetFormInput();
	$this->widgetSchema['store_id']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
	$this->widgetSchema['store_id']->setOption('renderer_options', array(
		'model' => 'Store',
		'url'   => $this->getOption('url'),
		'config'=>'{ width: 500,max: 100,highlight:false ,scroll: true,scrollHeight: 300}'	));
		
	$this->widgetSchema['created_from']  = new sfWidgetFormInputHidden();
	$this->widgetSchema['updated_from']  = new sfWidgetFormInputHidden();

	
	
	$this->widgetSchema->setLabels(array(
	  'description'    => 'Auftrag',
	  'contact_person'      => 'Kontaktperson',
	  'contact_info'   => 'Kontaktinformationen',
	  'newFiles'   => 'Dokumente',
	  'users_list'   => 'Bearbeiter',
	  'files_list'   => 'Dateien',
	  'store_id'   => 'Filiale',
	  'end'   => 'Ende',
	  'start'   => 'Beginn',
	  'job_state_id' => 'Status',
	  'job_type_id' => 'Typ',
	));

  }
/*
public function saveEmbeddedForms($con = null, $forms = null)
	{
	 if (null === $forms)
	 {
	   $files = $this->getValue('newFiles');
	   $forms = $this->embeddedForms;
     
	   foreach ($this->embeddedForms['newFiles'] as $name => $form)
	   {
	  
	     if (!isset($files[$name]))
	     {
	       unset($forms['newFiles'][$name]);
	     }
	   }
	 }

	 return parent::saveEmbeddedForms($con, $forms);
	}

*/

}
