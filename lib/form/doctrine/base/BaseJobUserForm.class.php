<?php

/**
 * JobUser form base class.
 *
 * @method JobUser getObject() Returns the current form's model object
 *
 * @package    workbook
 * @subpackage form
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseJobUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'job_id'  => new sfWidgetFormInputHidden(),
      'user_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'job_id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('job_id')), 'empty_value' => $this->getObject()->get('job_id'), 'required' => false)),
      'user_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('user_id')), 'empty_value' => $this->getObject()->get('user_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('job_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'JobUser';
  }

}
