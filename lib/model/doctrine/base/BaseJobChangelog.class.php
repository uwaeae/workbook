<?php

/**
 * BaseJobChangelog
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $job_id
 * @property integer $user_id
 * @property string $action
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property Job $Job
 * @property sfGuardUser $User
 * 
 * @method integer      getId()         Returns the current record's "id" value
 * @method integer      getJobId()      Returns the current record's "job_id" value
 * @method integer      getUserId()     Returns the current record's "user_id" value
 * @method string       getAction()     Returns the current record's "action" value
 * @method timestamp    getCreatedAt()  Returns the current record's "created_at" value
 * @method timestamp    getUpdatedAt()  Returns the current record's "updated_at" value
 * @method Job          getJob()        Returns the current record's "Job" value
 * @method sfGuardUser  getUser()       Returns the current record's "User" value
 * @method JobChangelog setId()         Sets the current record's "id" value
 * @method JobChangelog setJobId()      Sets the current record's "job_id" value
 * @method JobChangelog setUserId()     Sets the current record's "user_id" value
 * @method JobChangelog setAction()     Sets the current record's "action" value
 * @method JobChangelog setCreatedAt()  Sets the current record's "created_at" value
 * @method JobChangelog setUpdatedAt()  Sets the current record's "updated_at" value
 * @method JobChangelog setJob()        Sets the current record's "Job" value
 * @method JobChangelog setUser()       Sets the current record's "User" value
 * 
 * @package    workbook
 * @subpackage model
 * @author     Florian Engler
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseJobChangelog extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('jobchangelog');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('job_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('action', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('created_at', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('updated_at', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Job', array(
             'local' => 'job_id',
             'foreign' => 'id'));

        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}