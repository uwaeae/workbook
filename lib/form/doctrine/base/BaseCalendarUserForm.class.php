<?php

/**
 * CalendarUser form base class.
 *
 * @method CalendarUser getObject() Returns the current form's model object
 *
 * @package    workbook
 * @subpackage form
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCalendarUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'calendar_id' => new sfWidgetFormInputHidden(),
      'user_id'     => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'calendar_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('calendar_id')), 'empty_value' => $this->getObject()->get('calendar_id'), 'required' => false)),
      'user_id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('user_id')), 'empty_value' => $this->getObject()->get('user_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('calendar_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CalendarUser';
  }

}
