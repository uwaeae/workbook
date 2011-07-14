<?php

/**
 * Task filter form base class.
 *
 * @package    workbook
 * @subpackage filter
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTaskFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'start'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'end'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'scheduled'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'break'        => new sfWidgetFormFilterInput(),
      'overtime'     => new sfWidgetFormFilterInput(),
      'info'         => new sfWidgetFormFilterInput(),
      'approach'     => new sfWidgetFormFilterInput(),
      'job_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Job'), 'add_empty' => true)),
      'task_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TaskType'), 'add_empty' => true)),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'users_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
    ));

    $this->setValidators(array(
      'start'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'end'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'scheduled'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'break'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'overtime'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'info'         => new sfValidatorPass(array('required' => false)),
      'approach'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'job_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Job'), 'column' => 'id')),
      'task_type_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TaskType'), 'column' => 'id')),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'users_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('task_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addUsersListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.TaskUser TaskUser')
      ->andWhereIn('TaskUser.user_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Task';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'start'        => 'Date',
      'end'          => 'Date',
      'scheduled'    => 'Boolean',
      'break'        => 'Number',
      'overtime'     => 'Number',
      'info'         => 'Text',
      'approach'     => 'Number',
      'job_id'       => 'ForeignKey',
      'task_type_id' => 'ForeignKey',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
      'users_list'   => 'ManyKey',
    );
  }
}
