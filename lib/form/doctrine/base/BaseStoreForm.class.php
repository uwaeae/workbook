<?php

/**
 * Store form base class.
 *
 * @method Store getObject() Returns the current form's model object
 *
 * @package    workbook
 * @subpackage form
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseStoreForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'number'      => new sfWidgetFormInputText(),
      'contact'     => new sfWidgetFormInputText(),
      'info'        => new sfWidgetFormTextarea(),
      'street'      => new sfWidgetFormInputText(),
      'city'        => new sfWidgetFormInputText(),
      'country'     => new sfWidgetFormInputText(),
      'destrict'    => new sfWidgetFormInputText(),
      'fon'         => new sfWidgetFormTextarea(),
      'fax'         => new sfWidgetFormTextarea(),
      'postcode'    => new sfWidgetFormInputText(),
      'customer_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Customer'), 'add_empty' => true)),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'number'      => new sfValidatorString(array('max_length' => 8)),
      'contact'     => new sfValidatorString(array('max_length' => 255)),
      'info'        => new sfValidatorString(array('required' => false)),
      'street'      => new sfValidatorString(array('max_length' => 255)),
      'city'        => new sfValidatorString(array('max_length' => 255)),
      'country'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'destrict'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'fon'         => new sfValidatorString(),
      'fax'         => new sfValidatorString(array('required' => false)),
      'postcode'    => new sfValidatorInteger(),
      'customer_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Customer'), 'required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('store[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Store';
  }

}
