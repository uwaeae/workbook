<?php

/**
 * sfGuardUser form.
 *
 * @package    workbook
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserForm extends PluginsfGuardUserForm
{
  public function configure()
  {
	unset(
			$this['created_at'], 
			$this['updated_at'],
			$this['salt'],
			$this['algorithm'],
			$this['is_active'],
			$this['is_super_admin'],
			$this['last_login'],
			$this['groups_list'],
			$this['permissions_list'],
			$this['password'],
			$this['task_list']
			);
	
  }
}
