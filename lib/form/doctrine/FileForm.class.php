<?php

/**
 * File form.
 *
 * @package    workbook
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FileForm extends BaseFileForm
{
  public function configure()
  {

	$this->useFields(array('file','jobs_list'));

	//$this->setWidget('jobs_list', new sfWidgetFormInputHidden());

	$this->setWidget('file', new sfWidgetFormInputFile());
	$this->setValidator('file', new sfValidatorFile(array(
	    'path' => sfConfig::get('sf_upload_dir').'/documents',
		'required' => false,
	  )));
	
  }
}
