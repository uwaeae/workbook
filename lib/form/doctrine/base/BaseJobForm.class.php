<?php

/**
 * Job form base class.
 *
 * @method Job getObject() Returns the current form's model object
 *
 * @package    workbook
 * @subpackage form
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseJobForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'contact_person' => new sfWidgetFormInputText(),
      'contact_info'   => new sfWidgetFormInputText(),
      'job_type_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('JobType'), 'add_empty' => false)),
      'end'            => new sfWidgetFormDateTime(),
      'start'          => new sfWidgetFormDateTime(),
      'timeed'         => new sfWidgetFormDateTime(),
      'description'    => new sfWidgetFormTextarea(),
      'timeinterval'   => new sfWidgetFormInputText(),
      'job_state_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('JobState'), 'add_empty' => false)),
      'store_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Store'), 'add_empty' => false)),
      'created_at'     => new sfWidgetFormDateTime(),
      'created_from'   => new sfWidgetFormInputText(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'updated_from'   => new sfWidgetFormInputText(),
      'invoices_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Invoice')),
      'users_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
      'files_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'File')),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'contact_person' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'contact_info'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'job_type_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('JobType'))),
      'end'            => new sfValidatorDateTime(),
      'start'          => new sfValidatorDateTime(array('required' => false)),
      'timeed'         => new sfValidatorDateTime(array('required' => false)),
      'description'    => new sfValidatorString(array('required' => false)),
      'timeinterval'   => new sfValidatorInteger(array('required' => false)),
      'job_state_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('JobState'))),
      'store_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Store'))),
      'created_at'     => new sfValidatorDateTime(),
      'created_from'   => new sfValidatorInteger(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(),
      'updated_from'   => new sfValidatorInteger(array('required' => false)),
      'invoices_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Invoice', 'required' => false)),
      'users_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
      'files_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'File', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('job[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Job';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['invoices_list']))
    {
      $this->setDefault('invoices_list', $this->object->Invoices->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['users_list']))
    {
      $this->setDefault('users_list', $this->object->Users->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['files_list']))
    {
      $this->setDefault('files_list', $this->object->Files->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveInvoicesList($con);
    $this->saveUsersList($con);
    $this->saveFilesList($con);

    parent::doSave($con);
  }

  public function saveInvoicesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['invoices_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Invoices->getPrimaryKeys();
    $values = $this->getValue('invoices_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Invoices', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Invoices', array_values($link));
    }
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

  public function saveFilesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['files_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Files->getPrimaryKeys();
    $values = $this->getValue('files_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Files', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Files', array_values($link));
    }
  }

}
