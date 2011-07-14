<?php

/**
 * job module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage job
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseJobGeneratorConfiguration extends sfModelGeneratorConfiguration
{
  public function getActionsDefault()
  {
    return array();
  }

  public function getFormActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  }

  public function getNewActions()
  {
    return array();
  }

  public function getEditActions()
  {
    return array();
  }

  public function getListObjectActions()
  {
    return array(  '_edit' => NULL,  '_delete' => NULL,);
  }

  public function getListActions()
  {
    return array(  '_new' => NULL,);
  }

  public function getListBatchActions()
  {
    return array(  '_delete' => NULL,);
  }

  public function getListParams()
  {
    return '%%id%% - %%contact_person%% - %%contact_info%% - %%job_type_id%% - %%end%% - %%start%% - %%timeed%% - %%description%% - %%timeinterval%% - %%job_state_id%% - %%store_id%% - %%created_at%% - %%updated_at%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Job List';
  }

  public function getEditTitle()
  {
    return 'Edit Job';
  }

  public function getNewTitle()
  {
    return 'New Job';
  }

  public function getFilterDisplay()
  {
    return array();
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array();
  }

  public function getNewDisplay()
  {
    return array();
  }

  public function getListDisplay()
  {
    return array(  0 => 'id',  1 => 'contact_person',  2 => 'contact_info',  3 => 'job_type_id',  4 => 'end',  5 => 'start',  6 => 'timeed',  7 => 'description',  8 => 'timeinterval',  9 => 'job_state_id',  10 => 'store_id',  11 => 'created_at',  12 => 'updated_at',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'contact_person' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'contact_info' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'job_type_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'end' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'start' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'timeed' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'description' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'timeinterval' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'job_state_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'store_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'invoices_list' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'files_list' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'contact_person' => array(),
      'contact_info' => array(),
      'job_type_id' => array(),
      'end' => array(),
      'start' => array(),
      'timeed' => array(),
      'description' => array(),
      'timeinterval' => array(),
      'job_state_id' => array(),
      'store_id' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'invoices_list' => array(),
      'files_list' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'contact_person' => array(),
      'contact_info' => array(),
      'job_type_id' => array(),
      'end' => array(),
      'start' => array(),
      'timeed' => array(),
      'description' => array(),
      'timeinterval' => array(),
      'job_state_id' => array(),
      'store_id' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'invoices_list' => array(),
      'files_list' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'contact_person' => array(),
      'contact_info' => array(),
      'job_type_id' => array(),
      'end' => array(),
      'start' => array(),
      'timeed' => array(),
      'description' => array(),
      'timeinterval' => array(),
      'job_state_id' => array(),
      'store_id' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'invoices_list' => array(),
      'files_list' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'contact_person' => array(),
      'contact_info' => array(),
      'job_type_id' => array(),
      'end' => array(),
      'start' => array(),
      'timeed' => array(),
      'description' => array(),
      'timeinterval' => array(),
      'job_state_id' => array(),
      'store_id' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'invoices_list' => array(),
      'files_list' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'contact_person' => array(),
      'contact_info' => array(),
      'job_type_id' => array(),
      'end' => array(),
      'start' => array(),
      'timeed' => array(),
      'description' => array(),
      'timeinterval' => array(),
      'job_state_id' => array(),
      'store_id' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'invoices_list' => array(),
      'files_list' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'JobForm';
  }

  public function hasFilterForm()
  {
    return true;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return 'JobFormFilter';
  }

  public function getPagerClass()
  {
    return 'sfDoctrinePager';
  }

  public function getPagerMaxPerPage()
  {
    return 20;
  }

  public function getDefaultSort()
  {
    return array(null, null);
  }

  public function getTableMethod()
  {
    return '';
  }

  public function getTableCountMethod()
  {
    return '';
  }
}
