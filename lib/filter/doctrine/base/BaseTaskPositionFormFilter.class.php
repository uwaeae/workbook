<?php

/**
 * TaskPosition filter form base class.
 *
 * @package    workbook
 * @subpackage filter
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTaskPositionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'amount'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'item_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Item'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'amount'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'item_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Item'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('task_position_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TaskPosition';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'amount'  => 'Number',
      'item_id' => 'ForeignKey',
    );
  }
}
