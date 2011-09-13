<?php

/**
 * Job filter form base class.
 *
 * @package    workbook
 * @subpackage filter
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseJobFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contact_person' => new sfWidgetFormFilterInput(),
      'contact_info'   => new sfWidgetFormFilterInput(),
      'job_type_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('JobType'), 'add_empty' => true)),
      'end'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'start'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'timeed'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'description'    => new sfWidgetFormFilterInput(),
      'timeinterval'   => new sfWidgetFormFilterInput(),
      'job_state_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('JobState'), 'add_empty' => true)),
      'store_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Store'), 'add_empty' => true)),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_from'   => new sfWidgetFormFilterInput(),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_from'   => new sfWidgetFormFilterInput(),
      'invoices_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Invoice')),
      'files_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'File')),
    ));

    $this->setValidators(array(
      'contact_person' => new sfValidatorPass(array('required' => false)),
      'contact_info'   => new sfValidatorPass(array('required' => false)),
      'job_type_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('JobType'), 'column' => 'id')),
      'end'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'start'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'timeed'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'description'    => new sfValidatorPass(array('required' => false)),
      'timeinterval'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'job_state_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('JobState'), 'column' => 'id')),
      'store_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Store'), 'column' => 'id')),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_from'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_from'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'invoices_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Invoice', 'required' => false)),
      'files_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'File', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('job_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addInvoicesListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.JobInvoice JobInvoice')
      ->andWhereIn('JobInvoice.invoice_id', $values)
    ;
  }

  public function addFilesListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.FileJob FileJob')
      ->andWhereIn('FileJob.file_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Job';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'contact_person' => 'Text',
      'contact_info'   => 'Text',
      'job_type_id'    => 'ForeignKey',
      'end'            => 'Date',
      'start'          => 'Date',
      'timeed'         => 'Date',
      'description'    => 'Text',
      'timeinterval'   => 'Number',
      'job_state_id'   => 'ForeignKey',
      'store_id'       => 'ForeignKey',
      'created_at'     => 'Date',
      'created_from'   => 'Number',
      'updated_at'     => 'Date',
      'updated_from'   => 'Number',
      'invoices_list'  => 'ManyKey',
      'files_list'     => 'ManyKey',
    );
  }
}
