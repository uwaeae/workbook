<?php

/**
 * task module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage task
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTaskGeneratorConfiguration extends sfModelGeneratorConfiguration
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
    return '%%id%% - %%start%% - %%end%% - %%scheduled%% - %%break%% - %%overtime%% - %%info%% - %%approach%% - %%job_id%% - %%task_type_id%% - %%created_at%% - %%updated_at%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Task List';
  }

  public function getEditTitle()
  {
    return 'Edit Task';
  }

  public function getNewTitle()
  {
    return 'New Task';
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
    return array(  0 => 'id',  1 => 'start',  2 => 'end',  3 => 'scheduled',  4 => 'break',  5 => 'overtime',  6 => 'info',  7 => 'approach',  8 => 'job_id',  9 => 'task_type_id',  10 => 'created_at',  11 => 'updated_at',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'start' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'end' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'scheduled' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',),
      'break' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'overtime' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'info' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'approach' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'job_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'task_type_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'users_list' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'start' => array(),
      'end' => array(),
      'scheduled' => array(),
      'break' => array(),
      'overtime' => array(),
      'info' => array(),
      'approach' => array(),
      'job_id' => array(),
      'task_type_id' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'users_list' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'start' => array(),
      'end' => array(),
      'scheduled' => array(),
      'break' => array(),
      'overtime' => array(),
      'info' => array(),
      'approach' => array(),
      'job_id' => array(),
      'task_type_id' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'users_list' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'start' => array(),
      'end' => array(),
      'scheduled' => array(),
      'break' => array(),
      'overtime' => array(),
      'info' => array(),
      'approach' => array(),
      'job_id' => array(),
      'task_type_id' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'users_list' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'start' => array(),
      'end' => array(),
      'scheduled' => array(),
      'break' => array(),
      'overtime' => array(),
      'info' => array(),
      'approach' => array(),
      'job_id' => array(),
      'task_type_id' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'users_list' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'start' => array(),
      'end' => array(),
      'scheduled' => array(),
      'break' => array(),
      'overtime' => array(),
      'info' => array(),
      'approach' => array(),
      'job_id' => array(),
      'task_type_id' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'users_list' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'TaskForm';
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
    return 'TaskFormFilter';
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
