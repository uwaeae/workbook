<?php

/**
 * BaseJob
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $contact_person
 * @property string $contact_info
 * @property integer $job_type_id
 * @property timestamp $end
 * @property timestamp $start
 * @property timestamp $timeed
 * @property clob $description
 * @property integer $timeinterval
 * @property integer $job_state_id
 * @property integer $store_id
 * @property timestamp $created_at
 * @property integer $created_from
 * @property timestamp $updated_at
 * @property integer $updated_from
 * @property Store $Store
 * @property JobState $JobState
 * @property JobType $JobType
 * @property Doctrine_Collection $Invoices
 * @property Doctrine_Collection $Users
 * @property Doctrine_Collection $Tasks
 * @property Doctrine_Collection $Message
 * @property Doctrine_Collection $Files
 * @property Doctrine_Collection $Changelog
 * 
 * @method integer             getId()             Returns the current record's "id" value
 * @method string              getContactPerson()  Returns the current record's "contact_person" value
 * @method string              getContactInfo()    Returns the current record's "contact_info" value
 * @method integer             getJobTypeId()      Returns the current record's "job_type_id" value
 * @method timestamp           getEnd()            Returns the current record's "end" value
 * @method timestamp           getStart()          Returns the current record's "start" value
 * @method timestamp           getTimeed()         Returns the current record's "timeed" value
 * @method clob                getDescription()    Returns the current record's "description" value
 * @method integer             getTimeinterval()   Returns the current record's "timeinterval" value
 * @method integer             getJobStateId()     Returns the current record's "job_state_id" value
 * @method integer             getStoreId()        Returns the current record's "store_id" value
 * @method timestamp           getCreatedAt()      Returns the current record's "created_at" value
 * @method integer             getCreatedFrom()    Returns the current record's "created_from" value
 * @method timestamp           getUpdatedAt()      Returns the current record's "updated_at" value
 * @method integer             getUpdatedFrom()    Returns the current record's "updated_from" value
 * @method Store               getStore()          Returns the current record's "Store" value
 * @method JobState            getJobState()       Returns the current record's "JobState" value
 * @method JobType             getJobType()        Returns the current record's "JobType" value
 * @method Doctrine_Collection getInvoices()       Returns the current record's "Invoices" collection
 * @method Doctrine_Collection getUsers()          Returns the current record's "Users" collection
 * @method Doctrine_Collection getTasks()          Returns the current record's "Tasks" collection
 * @method Doctrine_Collection getMessage()        Returns the current record's "Message" collection
 * @method Doctrine_Collection getFiles()          Returns the current record's "Files" collection
 * @method Doctrine_Collection getChangelog()      Returns the current record's "Changelog" collection
 * @method Job                 setId()             Sets the current record's "id" value
 * @method Job                 setContactPerson()  Sets the current record's "contact_person" value
 * @method Job                 setContactInfo()    Sets the current record's "contact_info" value
 * @method Job                 setJobTypeId()      Sets the current record's "job_type_id" value
 * @method Job                 setEnd()            Sets the current record's "end" value
 * @method Job                 setStart()          Sets the current record's "start" value
 * @method Job                 setTimeed()         Sets the current record's "timeed" value
 * @method Job                 setDescription()    Sets the current record's "description" value
 * @method Job                 setTimeinterval()   Sets the current record's "timeinterval" value
 * @method Job                 setJobStateId()     Sets the current record's "job_state_id" value
 * @method Job                 setStoreId()        Sets the current record's "store_id" value
 * @method Job                 setCreatedAt()      Sets the current record's "created_at" value
 * @method Job                 setCreatedFrom()    Sets the current record's "created_from" value
 * @method Job                 setUpdatedAt()      Sets the current record's "updated_at" value
 * @method Job                 setUpdatedFrom()    Sets the current record's "updated_from" value
 * @method Job                 setStore()          Sets the current record's "Store" value
 * @method Job                 setJobState()       Sets the current record's "JobState" value
 * @method Job                 setJobType()        Sets the current record's "JobType" value
 * @method Job                 setInvoices()       Sets the current record's "Invoices" collection
 * @method Job                 setUsers()          Sets the current record's "Users" collection
 * @method Job                 setTasks()          Sets the current record's "Tasks" collection
 * @method Job                 setMessage()        Sets the current record's "Message" collection
 * @method Job                 setFiles()          Sets the current record's "Files" collection
 * @method Job                 setChangelog()      Sets the current record's "Changelog" collection
 * 
 * @package    workbook
 * @subpackage model
 * @author     Florian Engler
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseJob extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('job');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             ));
        $this->hasColumn('contact_person', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('contact_info', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('job_type_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('end', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             ));
        $this->hasColumn('start', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('timeed', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('description', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('timeinterval', 'integer', 1, array(
             'type' => 'integer',
             'notnull' => false,
             'length' => 1,
             ));
        $this->hasColumn('job_state_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('store_id', 'integer', null, array(
             'notnull' => true,
             'type' => 'integer',
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
        $this->hasOne('Store', array(
             'local' => 'store_id',
             'foreign' => 'id'));

        $this->hasOne('JobState', array(
             'local' => 'job_state_id',
             'foreign' => 'id'));

        $this->hasOne('JobType', array(
             'local' => 'job_type_id',
             'foreign' => 'id'));

        $this->hasMany('Invoice as Invoices', array(
             'refClass' => 'JobInvoice',
             'local' => 'job_id',
             'foreign' => 'invoice_id'));

        $this->hasMany('sfGuardUser as Users', array(
             'refClass' => 'JobUser',
             'local' => 'job_id',
             'foreign' => 'user_id'));

        $this->hasMany('Task as Tasks', array(
             'local' => 'id',
             'foreign' => 'job_id'));

        $this->hasMany('Message', array(
             'local' => 'id',
             'foreign' => 'job_id'));

        $this->hasMany('File as Files', array(
             'refClass' => 'FileJob',
             'local' => 'job_id',
             'foreign' => 'file_id'));

        $this->hasMany('JobChangelog as Changelog', array(
             'local' => 'id',
             'foreign' => 'job_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}