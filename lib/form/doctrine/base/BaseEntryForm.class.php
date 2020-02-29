<?php

/**
 * Entry form base class.
 *
 * @method Entry getObject() Returns the current form's model object
 *
 * @package    workbook
 * @subpackage form
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEntryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'description' => new sfWidgetFormInputText(),
      'amount'      => new sfWidgetFormInputText(),
	  'code' => new sfWidgetFormInputHidden(),
	  'unit' => new sfWidgetFormInputHidden(),
	  'name' => new sfWidgetFormInputHidden(),
      'task_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Task'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'description' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'amount'      => new sfValidatorInteger(),
	  'code' =>  new sfValidatorString(array('max_length' => 255, 'required' => false)),
	  'unit' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
	  'name' =>new sfValidatorString(array('max_length' => 255, 'required' => false)),
     // 'item_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Item'), 'required' => false)),
      'task_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Task'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('entry[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Entry';
  }

}
