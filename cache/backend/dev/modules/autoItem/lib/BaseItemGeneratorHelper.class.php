<?php

/**
 * item module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage item
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseItemGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'item' : 'item_'.$action;
  }
}
