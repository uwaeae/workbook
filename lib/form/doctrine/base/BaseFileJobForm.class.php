<?php

/**
 * FileJob form base class.
 *
 * @method FileJob getObject() Returns the current form's model object
 *
 * @package    workbook
 * @subpackage form
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFileJobForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'file_id' => new sfWidgetFormInputHidden(),
      'job_id'  => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'file_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('file_id')), 'empty_value' => $this->getObject()->get('file_id'), 'required' => false)),
      'job_id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('job_id')), 'empty_value' => $this->getObject()->get('job_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('file_job[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FileJob';
  }

}
