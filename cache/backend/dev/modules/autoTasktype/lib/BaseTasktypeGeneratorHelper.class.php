<?php

/**
 * tasktype module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage tasktype
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTasktypeGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'task_type' : 'task_type_'.$action;
  }
}
