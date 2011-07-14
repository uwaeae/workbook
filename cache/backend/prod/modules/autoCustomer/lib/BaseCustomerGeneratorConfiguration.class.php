<?php

/**
 * customer module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage customer
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCustomerGeneratorConfiguration extends sfModelGeneratorConfiguration
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
    return array(  '_edit' => NULL,  '_delete' => NULL,  'addStore' =>   array(    'label' => 'Filiale Hinzufügen',    'action' => 'addStore',  ),);
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
    return '%%=number%% - %%=company%% - %%_stores%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Kundenverwaltung';
  }

  public function getEditTitle()
  {
    return 'Bearbeiten von %%company%%';
  }

  public function getNewTitle()
  {
    return 'Neuer Kunde';
  }

  public function getFilterDisplay()
  {
    return array(  0 => 'company',  1 => 'number',);
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array(  'Kunde' =>   array(    0 => 'company',    1 => 'logo',    2 => 'url',    3 => 'number',  ),);
  }

  public function getNewDisplay()
  {
    return array();
  }

  public function getListDisplay()
  {
    return array(  0 => '=number',  1 => '=company',  2 => '_stores',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'company' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Firmenname',),
      'logo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Firmenlogo',  'help' => 'Hier kannst du ein Firmenlogo angeben',),
      'url' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Homepage',  'help' => 'Hier kann die Firmenwebseite angegeben werden',),
      'number' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',  'label' => 'Kundennummer',  'help' => 'Hier wird die Interne Kundennummer angegeben',),
      'headoffice' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'company' => array(),
      'logo' => array(),
      'url' => array(),
      'number' => array(),
      'headoffice' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'company' => array(),
      'logo' => array(),
      'url' => array(),
      'number' => array(),
      'headoffice' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'company' => array(),
      'logo' => array(),
      'url' => array(),
      'number' => array(),
      'headoffice' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'company' => array(),
      'logo' => array(),
      'url' => array(),
      'number' => array(),
      'headoffice' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'company' => array(),
      'logo' => array(),
      'url' => array(),
      'number' => array(),
      'headoffice' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'CustomerForm';
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
    return 'CustomerFormFilter';
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
