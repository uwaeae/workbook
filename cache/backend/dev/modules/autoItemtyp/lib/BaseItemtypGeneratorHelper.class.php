<?php

/**
 * itemtyp module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage itemtyp
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseItemtypGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'item_typ' : 'item_typ_'.$action;
  }
}
