<?php

/**
 * JobInvoice form base class.
 *
 * @method JobInvoice getObject() Returns the current form's model object
 *
 * @package    workbook
 * @subpackage form
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseJobInvoiceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'job_id'     => new sfWidgetFormInputHidden(),
      'invoice_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'job_id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('job_id')), 'empty_value' => $this->getObject()->get('job_id'), 'required' => false)),
      'invoice_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('invoice_id')), 'empty_value' => $this->getObject()->get('invoice_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('job_invoice[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'JobInvoice';
  }

}
