<?php

/**
 * Customer filter form base class.
 *
 * @package    workbook
 * @subpackage filter
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCustomerFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'company'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'logo'       => new sfWidgetFormFilterInput(),
      'url'        => new sfWidgetFormFilterInput(),
      'number'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'headoffice' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Store'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'company'    => new sfValidatorPass(array('required' => false)),
      'logo'       => new sfValidatorPass(array('required' => false)),
      'url'        => new sfValidatorPass(array('required' => false)),
      'number'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'headoffice' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Store'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('customer_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Customer';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'company'    => 'Text',
      'logo'       => 'Text',
      'url'        => 'Text',
      'number'     => 'Number',
      'headoffice' => 'ForeignKey',
    );
  }
}
