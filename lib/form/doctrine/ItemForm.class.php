<?php

/**
 * Item form.
 *
 * @package    workbook
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ItemForm extends BaseItemForm
{
  public function configure()
  {
	 $this->setValidators(array(
	      'name'    => new sfValidatorString(array('required' => false)),
	      'code'   =>  new sfValidatorString(array('required' => false)),
	    ));
	 $this->mergePostValidator(new TaskItemValidatorSchema());
  }
}
