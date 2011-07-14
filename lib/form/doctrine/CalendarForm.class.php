<?php

/**
 * Calendar form.
 *
 * @package    workbook
 * @subpackage form
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CalendarForm extends BaseCalendarForm
{
  public function configure()
  {
	unset(
			$this['created_at'], $this['updated_at'], $this['type_id']
		);
	$this->widgetSchema['beginn'] =  new sfWidgetFormJQueryDate(array( 'image' => '/images/icons/calendar.png','config' => '{}',));
	$this->setDefault('beginn', date('c',mktime(8,0,0,date("m"),date("d")+1,date("Y"))));
	$this->setDefault('duration', 1);
	$this->widgetSchema['users_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser'));
	$this->widgetSchema['users_list']->setOption('expanded', true);
	
	$this->widgetSchema->setLabels(array(
		'job_id' => 'Auftrag',
		'beginn'    => 'Thermin',
		'duration'      => 'Geplante Zeit',
		'users_list'   => 'Eingeteilt',
		'type_id'   => 'Termin Type',
		
	));
  }
}
