<?php

/**
 * Customer form base class.
 *
 * @method Customer getObject() Returns the current form's model object
 *
 * @package    workbook
 * @subpackage form
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCustomerForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'company'    => new sfWidgetFormInputText(),
      'logo'       => new sfWidgetFormInputText(),
      'url'        => new sfWidgetFormInputText(),
      'number'     => new sfWidgetFormInputText(),
      'headoffice' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Store'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'company'    => new sfValidatorString(array('max_length' => 255)),
      'logo'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'url'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'number'     => new sfValidatorInteger(),
      'headoffice' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Store'))),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Customer', 'column' => array('number')))
    );

    $this->widgetSchema->setNameFormat('customer[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Customer';
  }

}
