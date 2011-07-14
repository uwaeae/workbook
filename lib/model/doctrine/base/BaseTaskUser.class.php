<?php

/**
 * BaseTaskUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $task_id
 * @property integer $user_id
 * @property sfGuardUser $User
 * 
 * @method integer     getTaskId()  Returns the current record's "task_id" value
 * @method integer     getUserId()  Returns the current record's "user_id" value
 * @method sfGuardUser getUser()    Returns the current record's "User" value
 * @method TaskUser    setTaskId()  Sets the current record's "task_id" value
 * @method TaskUser    setUserId()  Sets the current record's "user_id" value
 * @method TaskUser    setUser()    Sets the current record's "User" value
 * 
 * @package    workbook
 * @subpackage model
 * @author     Florian Engler
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTaskUser extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('task_user');
        $this->hasColumn('task_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id'));
    }
}