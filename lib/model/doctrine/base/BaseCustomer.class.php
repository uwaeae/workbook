<?php

/**
 * BaseCustomer
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $company
 * @property string $logo
 * @property string $url
 * @property integer $number
 * @property integer $headoffice
 * @property Doctrine_Collection $Stores
 * 
 * @method integer             getId()         Returns the current record's "id" value
 * @method string              getCompany()    Returns the current record's "company" value
 * @method string              getLogo()       Returns the current record's "logo" value
 * @method string              getUrl()        Returns the current record's "url" value
 * @method integer             getNumber()     Returns the current record's "number" value
 * @method integer             getHeadoffice() Returns the current record's "headoffice" value
 * @method Doctrine_Collection getStores()     Returns the current record's "Stores" collection
 * @method Customer            setId()         Sets the current record's "id" value
 * @method Customer            setCompany()    Sets the current record's "company" value
 * @method Customer            setLogo()       Sets the current record's "logo" value
 * @method Customer            setUrl()        Sets the current record's "url" value
 * @method Customer            setNumber()     Sets the current record's "number" value
 * @method Customer            setHeadoffice() Sets the current record's "headoffice" value
 * @method Customer            setStores()     Sets the current record's "Stores" collection
 * 
 * @package    workbook
 * @subpackage model
 * @author     Florian Engler
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCustomer extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('customer');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             ));
        $this->hasColumn('company', 'string', 255, array(
             'notnull' => true,
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('logo', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('url', 'string', 255, array(
             'notnull' => false,
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('number', 'integer', 5, array(
             'notnull' => true,
             'autoincrement' => false,
             'unique' => true,
             'type' => 'integer',
             'length' => 5,
             ));
        $this->hasColumn('headoffice', 'integer', 5, array(
             'notnull' => false,
             'type' => 'integer',
             'length' => 5,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Store as Stores', array(
             'local' => 'id',
             'foreign' => 'customer_id'));
    }
}