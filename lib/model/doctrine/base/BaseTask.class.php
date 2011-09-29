<?php

/**
 * BaseTask
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property timestamp $start
 * @property timestamp $end
 * @property boolean $scheduled
 * @property integer $break
 * @property integer $overtime
 * @property clob $info
 * @property integer $approach
 * @property integer $job_id
 * @property integer $task_type_id
 * @property decimal $correction_time
 * @property string $correction_info
 * @property timestamp $created_at
 * @property integer $created_from
 * @property timestamp $updated_at
 * @property integer $updated_from
 * @property Job $Job
 * @property TaskType $TaskType
 * @property Doctrine_Collection $Users
 * @property Doctrine_Collection $Entry
 * @property Doctrine_Collection $Changelog
 * 
 * @method integer             getId()              Returns the current record's "id" value
 * @method timestamp           getStart()           Returns the current record's "start" value
 * @method timestamp           getEnd()             Returns the current record's "end" value
 * @method boolean             getScheduled()       Returns the current record's "scheduled" value
 * @method integer             getBreak()           Returns the current record's "break" value
 * @method integer             getOvertime()        Returns the current record's "overtime" value
 * @method clob                getInfo()            Returns the current record's "info" value
 * @method integer             getApproach()        Returns the current record's "approach" value
 * @method integer             getJobId()           Returns the current record's "job_id" value
 * @method integer             getTaskTypeId()      Returns the current record's "task_type_id" value
 * @method decimal             getCorrectionTime()  Returns the current record's "correction_time" value
 * @method string              getCorrectionInfo()  Returns the current record's "correction_info" value
 * @method timestamp           getCreatedAt()       Returns the current record's "created_at" value
 * @method integer             getCreatedFrom()     Returns the current record's "created_from" value
 * @method timestamp           getUpdatedAt()       Returns the current record's "updated_at" value
 * @method integer             getUpdatedFrom()     Returns the current record's "updated_from" value
 * @method Job                 getJob()             Returns the current record's "Job" value
 * @method TaskType            getTaskType()        Returns the current record's "TaskType" value
 * @method Doctrine_Collection getUsers()           Returns the current record's "Users" collection
 * @method Doctrine_Collection getEntry()           Returns the current record's "Entry" collection
 * @method Doctrine_Collection getChangelog()       Returns the current record's "Changelog" collection
 * @method Task                setId()              Sets the current record's "id" value
 * @method Task                setStart()           Sets the current record's "start" value
 * @method Task                setEnd()             Sets the current record's "end" value
 * @method Task                setScheduled()       Sets the current record's "scheduled" value
 * @method Task                setBreak()           Sets the current record's "break" value
 * @method Task                setOvertime()        Sets the current record's "overtime" value
 * @method Task                setInfo()            Sets the current record's "info" value
 * @method Task                setApproach()        Sets the current record's "approach" value
 * @method Task                setJobId()           Sets the current record's "job_id" value
 * @method Task                setTaskTypeId()      Sets the current record's "task_type_id" value
 * @method Task                setCorrectionTime()  Sets the current record's "correction_time" value
 * @method Task                setCorrectionInfo()  Sets the current record's "correction_info" value
 * @method Task                setCreatedAt()       Sets the current record's "created_at" value
 * @method Task                setCreatedFrom()     Sets the current record's "created_from" value
 * @method Task                setUpdatedAt()       Sets the current record's "updated_at" value
 * @method Task                setUpdatedFrom()     Sets the current record's "updated_from" value
 * @method Task                setJob()             Sets the current record's "Job" value
 * @method Task                setTaskType()        Sets the current record's "TaskType" value
 * @method Task                setUsers()           Sets the current record's "Users" collection
 * @method Task                setEntry()           Sets the current record's "Entry" collection
 * @method Task                setChangelog()       Sets the current record's "Changelog" collection
 * 
 * @package    workbook
 * @subpackage model
 * @author     Florian Engler
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTask extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('task');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             ));
        $this->hasColumn('start', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('end', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('scheduled', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('break', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('overtime', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('info', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('approach', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('job_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('task_type_id', 'integer', null, array(
             'type' => 'integer',
             'default' => 1,
             ));
        $this->hasColumn('correction_time', 'decimal', null, array(
             'type' => 'decimal',
             'scale' => 2,
             ));
        $this->hasColumn('correction_info', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('created_at', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('created_from', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('updated_at', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('updated_from', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Job', array(
             'local' => 'job_id',
             'foreign' => 'id'));

        $this->hasOne('TaskType', array(
             'local' => 'task_type_id',
             'foreign' => 'id'));

        $this->hasMany('sfGuardUser as Users', array(
             'refClass' => 'TaskUser',
             'local' => 'task_id',
             'foreign' => 'user_id'));

        $this->hasMany('Entry', array(
             'local' => 'id',
             'foreign' => 'task_id'));

        $this->hasMany('TaskChangelog as Changelog', array(
             'local' => 'id',
             'foreign' => 'task_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}