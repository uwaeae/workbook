<?php

/**
 * File filter form base class.
 *
 * @package    workbook
 * @subpackage filter
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'file'      => new sfWidgetFormFilterInput(),
      'jobs_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Job')),
    ));

    $this->setValidators(array(
      'name'      => new sfValidatorPass(array('required' => false)),
      'file'      => new sfValidatorPass(array('required' => false)),
      'jobs_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Job', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('file_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addJobsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('FileJob.job_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'File';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'name'      => 'Text',
      'file'      => 'Text',
      'jobs_list' => 'ManyKey',
    );
  }
}
