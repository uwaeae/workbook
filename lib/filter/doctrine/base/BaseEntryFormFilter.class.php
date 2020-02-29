<?php

/**
 * Entry filter form base class.
 *
 * @package    workbook
 * @subpackage filter
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEntryFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'description' => new sfWidgetFormFilterInput(),
      'amount'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'item_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Item'), 'add_empty' => true)),
      'task_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Task'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'description' => new sfValidatorPass(array('required' => false)),
      'amount'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'item_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Item'), 'column' => 'id')),
      'task_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Task'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('entry_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Entry';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'description' => 'Text',
      'amount'      => 'Number',
      'item_id'     => 'ForeignKey',
      'task_id'     => 'ForeignKey',
    );
  }
}
