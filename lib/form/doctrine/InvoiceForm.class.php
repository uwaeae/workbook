<?php

/**
 * Invoice form.
 *
 * @package    workbook
 * @subpackage form
 * @author     Florian Engler
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InvoiceForm extends BaseInvoiceForm
{
  public function configure()
  {
	      unset(
			      $this['created_at'], $this['updated_at']
				 );
        $this->widgetSchema['jobs_list'] = new sfWidgetFormInputHidden();
  }
}
