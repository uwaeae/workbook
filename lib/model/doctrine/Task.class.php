<?php

/**
 * Task
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    workbook
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Task extends BaseTask
{
	public function hasUser($id)
		{
		foreach ($this->getUsers() as $user) {
			if($user->getId() == $id) return true;
		}
		return false;
	}
	public function getCreator()
		{
		return 	Doctrine_Core::getTable('sfGuardUser')
							->find($this->getCreatedFrom() );
	}

  public function getUpdater()
  {
       return 	Doctrine_Core::getTable('sfGuardUser')
            ->find($this->getUpdatedFrom() );
   }


	public function getStartDate(){
		$this->getDateTimeObject('start')->format('d.m.Y H:i');
	}

}
