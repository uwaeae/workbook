<?php

/**
 * ItemEntry form base class.
 *
 * @method ItemEntry getObject() Returns the current form's model object
 *
 * @package    workbook
 * @subpackage form
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseItemEntryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'amount'  => new sfWidgetFormInputText(),
      'item_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Item'), 'add_empty' => true)),
      'job_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Job'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'amount'  => new sfValidatorInteger(),
      'item_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Item'), 'required' => false)),
      'job_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Job'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('item_entry[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ItemEntry';
  }

}
