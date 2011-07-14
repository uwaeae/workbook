<?php

/**
 * File form base class.
 *
 * @method File getObject() Returns the current form's model object
 *
 * @package    workbook
 * @subpackage form
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'name'      => new sfWidgetFormInputText(),
      'file'      => new sfWidgetFormInputText(),
      'jobs_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Job')),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'      => new sfValidatorString(array('max_length' => 64)),
      'file'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'jobs_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Job', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('file[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'File';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['jobs_list']))
    {
      $this->setDefault('jobs_list', $this->object->Jobs->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveJobsList($con);

    parent::doSave($con);
  }

  public function saveJobsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['jobs_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Jobs->getPrimaryKeys();
    $values = $this->getValue('jobs_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Jobs', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Jobs', array_values($link));
    }
  }

}
