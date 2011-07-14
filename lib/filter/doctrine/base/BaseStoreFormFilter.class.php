<?php

/**
 * Store filter form base class.
 *
 * @package    workbook
 * @subpackage filter
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseStoreFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'number'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'contact'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'info'        => new sfWidgetFormFilterInput(),
      'street'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'city'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'country'     => new sfWidgetFormFilterInput(),
      'destrict'    => new sfWidgetFormFilterInput(),
      'fon'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fax'         => new sfWidgetFormFilterInput(),
      'postcode'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'customer_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Customer'), 'add_empty' => true)),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'number'      => new sfValidatorPass(array('required' => false)),
      'contact'     => new sfValidatorPass(array('required' => false)),
      'info'        => new sfValidatorPass(array('required' => false)),
      'street'      => new sfValidatorPass(array('required' => false)),
      'city'        => new sfValidatorPass(array('required' => false)),
      'country'     => new sfValidatorPass(array('required' => false)),
      'destrict'    => new sfValidatorPass(array('required' => false)),
      'fon'         => new sfValidatorPass(array('required' => false)),
      'fax'         => new sfValidatorPass(array('required' => false)),
      'postcode'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'customer_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Customer'), 'column' => 'id')),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('store_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Store';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'number'      => 'Text',
      'contact'     => 'Text',
      'info'        => 'Text',
      'street'      => 'Text',
      'city'        => 'Text',
      'country'     => 'Text',
      'destrict'    => 'Text',
      'fon'         => 'Text',
      'fax'         => 'Text',
      'postcode'    => 'Number',
      'customer_id' => 'ForeignKey',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}
