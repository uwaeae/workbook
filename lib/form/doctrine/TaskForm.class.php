<?php

/**
 * Task form.
 *
 * @package    workbook
 * @subpackage form
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TaskForm extends BaseTaskForm
{
  public function configure()
  {
	unset(
	      $this['created_at'], $this['updated_at']
		 );
	$this->widgetSchema['job_id'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['scheduled'] = new sfWidgetFormInputHidden();
	$this->widgetSchema['correction_time'] = new sfWidgetFormInputText();
    $this->widgetSchema['correction_info'] = new sfWidgetFormTextarea();
	
	$this->setDefault('scheduled',0);
		
	switch ($this->getOption('type')) {
		case '0': //planung
			$this->setDefault('task_type_id',1);
			$this->widgetSchema['task_type_id'] = new sfWidgetFormInputHidden();
			$this->widgetSchema['approach'] = new sfWidgetFormInputHidden();
			$this->widgetSchema['break'] = new sfWidgetFormInputHidden();
			$this->widgetSchema['overtime'] = new sfWidgetFormInputHidden();
			$this->widgetSchema['info'] = new sfWidgetFormInputHidden();

			$this->setDefault('scheduled',1);
			$this->setDefault('end', date('Y/m/d H:i', mktime(16,0,0,date("m"),date("d") + 1,date("Y"))));
			$this->setDefault('start', date('Y/m/d H:i',mktime(8,0,0,date("m"),date("d") + 1,date("Y"))));
			break;
		case '1': //auftrag
			$this->setDefault('task_type_id',1);
			$this->widgetSchema['task_type_id'] = new sfWidgetFormInputHidden();
			for ($i=0; $i < 13; $i++) { 
				$approach[] = $i * 15;	
			}
			$this->widgetSchema['break'] = new sfWidgetFormChoice(array('choices' => array('0','15','30', '45', '60')));
			$this->widgetSchema['approach'] = new sfWidgetFormChoice(array('choices' => 	$approach,'default'   => '2'));
			$this->setDefault('end', date('Y/m/d H:i', time()));
			$this->setDefault('start', date('Y/m/d H:i',mktime(8,0,0,date("m"),date("d"),date("Y"))));
			$this->setDefault('overtime', (date('H') > 20? date('H')-20: 0));
			break;
		case '2': //krank
			$this->setDefault('end', date('Y/m/d H:i',mktime(15,59,0,date("m"),date("d"),date("Y"))));
			$this->setDefault('start', date('Y/m/d H:i',mktime(8,0,0,date("m"),date("d"),date("Y"))));
			$this->setDefault('task_type_id',2);
		//	$this->widgetSchema['users_list'] = new sfWidgetFormInputHidden();
			$this->setDefault('approach',30);
			$this->widgetSchema['approach'] = new sfWidgetFormInputHidden();
			$this->setDefault('break',0);
			$this->widgetSchema['break'] = new sfWidgetFormInputHidden();
			$this->setDefault('overtime',0);
			$this->widgetSchema['overtime'] = new sfWidgetFormInputHidden();
			$this->setDefault('info','Krank');
			break;
		case '3': //urlaub
			$this->setDefault('end', date('Y/m/d H:i',mktime(15,59,0,date("m"),date("d"),date("Y"))));
			$this->setDefault('start', date('Y/m/d H:i',mktime(8,0,0,date("m"),date("d"),date("Y"))));
			$this->setDefault('info','Urlaub');
			$this->setDefault('task_type_id',3);
		//	$this->widgetSchema['users_list'] = new sfWidgetFormInputHidden();
			$this->setDefault('approach',0);
			$this->widgetSchema['approach'] = new sfWidgetFormInputHidden();
			$this->setDefault('break',0);
			$this->widgetSchema['break'] = new sfWidgetFormInputHidden();
			$this->setDefault('overtime',0);
			$this->widgetSchema['overtime'] = new sfWidgetFormInputHidden();
			
			break;
		
	}
	


	$this->widgetSchema['end'] = new sfWidgetFormJQueryDate(array( 'image' => '/images/icons/calendar.png','config' => '{}',));
	$this->widgetSchema['start'] =  new sfWidgetFormJQueryDate(array( 'image' => '/images/icons/calendar.png','config' => '{}',));

	$this->widgetSchema['created_from']  = new sfWidgetFormInputHidden();
	$this->widgetSchema['updated_from']  = new sfWidgetFormInputHidden();



	$this->widgetSchema->setLabels(array(
	  'info'    => 'Durchgeführte Arbeiten',
	  'break'    => 'Pause',
	  'approach' => 'Anfahrt',
	  'end'   => 'Ende',
	  'start'   => 'Beginn',
	 'users_list' => 'Mitarbeiter',
	'overtime' => '30 % Stunden',
	'task_type_id' => 'Type',
	'correction_time' => 'Korrektur Zeit',
	'correction_info' => 'Korrektur Bemerkung'
	
	));	
  }


}
