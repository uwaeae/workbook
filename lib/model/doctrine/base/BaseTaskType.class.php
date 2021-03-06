<?php

/**
 * BaseTaskType
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property Doctrine_Collection $Tasks
 * 
 * @method integer             getId()    Returns the current record's "id" value
 * @method string              getName()  Returns the current record's "name" value
 * @method Doctrine_Collection getTasks() Returns the current record's "Tasks" collection
 * @method TaskType            setId()    Sets the current record's "id" value
 * @method TaskType            setName()  Sets the current record's "name" value
 * @method TaskType            setTasks() Sets the current record's "Tasks" collection
 * 
 * @package    workbook
 * @subpackage model
 * @author     Florian Engler
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTaskType extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('task_type');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', 64, array(
             'type' => 'string',
             'length' => 64,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Task as Tasks', array(
             'local' => 'id',
             'foreign' => 'task_type_id'));
    }
}