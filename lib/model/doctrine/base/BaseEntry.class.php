<?php

/**
 * BaseEntry
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $code
 * @property string $unit
 * @property integer $amount
 * @property integer $item_id
 * @property integer $task_id
 * @property Task $Task
 * 
 * @method integer getId()          Returns the current record's "id" value
 * @method string  getName()        Returns the current record's "name" value
 * @method string  getDescription() Returns the current record's "description" value
 * @method string  getCode()        Returns the current record's "code" value
 * @method string  getUnit()        Returns the current record's "unit" value
 * @method integer getAmount()      Returns the current record's "amount" value

 * @method integer getTaskId()      Returns the current record's "task_id" value
 * @method Task    getTask()        Returns the current record's "Task" value
 * @method Entry   setId()          Sets the current record's "id" value
 * @method Entry   setName()        Sets the current record's "name" value
 * @method Entry   setDescription() Sets the current record's "description" value
 * @method Entry   setCode()        Sets the current record's "code" value
 * @method Entry   setUnit()        Sets the current record's "unit" value
 * @method Entry   setAmount()      Sets the current record's "amount" value

 * @method Entry   setTaskId()      Sets the current record's "task_id" value
 * @method Entry   setTask()        Sets the current record's "Task" value
 * 
 * @package    workbook
 * @subpackage model
 * @author     Florian Engler
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEntry extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('Entry');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             ));
        $this->hasColumn('name', 'string', 64, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 64,
             ));
        $this->hasColumn('description', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('code', 'string', 10, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 10,
             ));
        $this->hasColumn('unit', 'string', 32, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 32,
             ));
        $this->hasColumn('amount', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
      /*  $this->hasColumn('item_id', 'integer', null, array(
             'type' => 'integer',
             ));*/
        $this->hasColumn('task_id', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Task', array(
             'local' => 'task_id',
             'foreign' => 'id'));
    }
}