<?php

/**
 * Task form base class.
 *
 * @method Task getObject() Returns the current form's model object
 *
 * @package    workbook
 * @subpackage form
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTaskForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'start'        => new sfWidgetFormDateTime(),
      'end'          => new sfWidgetFormDateTime(),
      'scheduled'    => new sfWidgetFormInputCheckbox(),
      'break'        => new sfWidgetFormInputText(),
      'overtime'     => new sfWidgetFormInputText(),
      'info'         => new sfWidgetFormTextarea(),
      'approach'     => new sfWidgetFormInputText(),
      'job_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Job'), 'add_empty' => true)),
      'task_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TaskType'), 'add_empty' => true)),
      'created_at'   => new sfWidgetFormDateTime(),
      'created_from' => new sfWidgetFormInputText(),
      'updated_at'   => new sfWidgetFormDateTime(),
      'updated_from' => new sfWidgetFormInputText(),
      'users_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'start'        => new sfValidatorDateTime(array('required' => false)),
      'end'          => new sfValidatorDateTime(array('required' => false)),
      'scheduled'    => new sfValidatorBoolean(array('required' => false)),
      'break'        => new sfValidatorInteger(array('required' => false)),
      'overtime'     => new sfValidatorInteger(array('required' => false)),
      'info'         => new sfValidatorString(array('required' => false)),
      'approach'     => new sfValidatorInteger(array('required' => false)),
      'job_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Job'), 'required' => false)),
      'task_type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TaskType'), 'required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'created_from' => new sfValidatorInteger(array('required' => false)),
      'updated_at'   => new sfValidatorDateTime(),
      'updated_from' => new sfValidatorInteger(array('required' => false)),
      'users_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('task[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Task';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['users_list']))
    {
      $this->setDefault('users_list', $this->object->Users->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveUsersList($con);

    parent::doSave($con);
  }

  public function saveUsersList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['users_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Users->getPrimaryKeys();
    $values = $this->getValue('users_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Users', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Users', array_values($link));
    }
  }

}
