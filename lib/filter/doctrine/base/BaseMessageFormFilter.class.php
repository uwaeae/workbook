<?php

/**
 * Message filter form base class.
 *
 * @package    workbook
 * @subpackage filter
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMessageFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'parent'     => new sfWidgetFormFilterInput(),
      'sender'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'reciver'    => new sfWidgetFormFilterInput(),
      'job_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Job'), 'add_empty' => true)),
      'body'       => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'parent'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'sender'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'reciver'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'job_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Job'), 'column' => 'id')),
      'body'       => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('message_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Message';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'parent'     => 'Number',
      'sender'     => 'ForeignKey',
      'reciver'    => 'Number',
      'job_id'     => 'ForeignKey',
      'body'       => 'Text',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
