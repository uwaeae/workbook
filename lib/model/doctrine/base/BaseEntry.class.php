<?php

/**
 * BaseEntry
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $description
 * @property integer $amount
 * @property integer $item_id
 * @property integer $job_id
 * @property Job $Job
 * @property Item $Item
 * 
 * @method integer getId()          Returns the current record's "id" value
 * @method string  getDescription() Returns the current record's "description" value
 * @method integer getAmount()      Returns the current record's "amount" value
 * @method integer getItemId()      Returns the current record's "item_id" value
 * @method integer getJobId()       Returns the current record's "job_id" value
 * @method Job     getJob()         Returns the current record's "Job" value
 * @method Item    getItem()        Returns the current record's "Item" value
 * @method Entry   setId()          Sets the current record's "id" value
 * @method Entry   setDescription() Sets the current record's "description" value
 * @method Entry   setAmount()      Sets the current record's "amount" value
 * @method Entry   setItemId()      Sets the current record's "item_id" value
 * @method Entry   setJobId()       Sets the current record's "job_id" value
 * @method Entry   setJob()         Sets the current record's "Job" value
 * @method Entry   setItem()        Sets the current record's "Item" value
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
        $this->hasColumn('description', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('amount', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('item_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('job_id', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Job', array(
             'local' => 'job_id',
             'foreign' => 'id'));

        $this->hasOne('Item', array(
             'local' => 'item_id',
             'foreign' => 'id'));
    }
}