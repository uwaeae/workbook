<?php

/**
 * BaseStore
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $number
 * @property string $contact
 * @property clob $info
 * @property string $street
 * @property string $city
 * @property string $country
 * @property string $destrict
 * @property string $fon
 * @property string $fax
 * @property integer $postcode
 * @property integer $customer_id
 * @property Customer $Customer
 * @property Job $Job
 * 
 * @method integer  getId()          Returns the current record's "id" value
 * @method string   getNumber()      Returns the current record's "number" value
 * @method string   getContact()     Returns the current record's "contact" value
 * @method clob     getInfo()        Returns the current record's "info" value
 * @method string   getStreet()      Returns the current record's "street" value
 * @method string   getCity()        Returns the current record's "city" value
 * @method string   getCountry()     Returns the current record's "country" value
 * @method string   getDestrict()    Returns the current record's "destrict" value
 * @method string   getFon()         Returns the current record's "fon" value
 * @method string   getFax()         Returns the current record's "fax" value
 * @method integer  getPostcode()    Returns the current record's "postcode" value
 * @method integer  getCustomerId()  Returns the current record's "customer_id" value
 * @method Customer getCustomer()    Returns the current record's "Customer" value
 * @method Job      getJob()         Returns the current record's "Job" value
 * @method Store    setId()          Sets the current record's "id" value
 * @method Store    setNumber()      Sets the current record's "number" value
 * @method Store    setContact()     Sets the current record's "contact" value
 * @method Store    setInfo()        Sets the current record's "info" value
 * @method Store    setStreet()      Sets the current record's "street" value
 * @method Store    setCity()        Sets the current record's "city" value
 * @method Store    setCountry()     Sets the current record's "country" value
 * @method Store    setDestrict()    Sets the current record's "destrict" value
 * @method Store    setFon()         Sets the current record's "fon" value
 * @method Store    setFax()         Sets the current record's "fax" value
 * @method Store    setPostcode()    Sets the current record's "postcode" value
 * @method Store    setCustomerId()  Sets the current record's "customer_id" value
 * @method Store    setCustomer()    Sets the current record's "Customer" value
 * @method Store    setJob()         Sets the current record's "Job" value
 * 
 * @package    workbook
 * @subpackage model
 * @author     Florian Engler
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseStore extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('store');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             ));
        $this->hasColumn('number', 'string', 8, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 8,
             ));
        $this->hasColumn('contact', 'string', 255, array(
             'notnull' => true,
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('info', 'clob', null, array(
             'notnull' => false,
             'type' => 'clob',
             ));
        $this->hasColumn('street', 'string', 255, array(
             'notnull' => true,
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('city', 'string', 255, array(
             'notnull' => true,
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('country', 'string', 255, array(
             'notnull' => false,
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('destrict', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('fon', 'string', null, array(
             'notnull' => true,
             'type' => 'string',
             ));
        $this->hasColumn('fax', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('postcode', 'integer', 5, array(
             'notnull' => true,
             'type' => 'integer',
             'length' => 5,
             ));
        $this->hasColumn('customer_id', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Customer', array(
             'local' => 'customer_id',
             'foreign' => 'id'));

        $this->hasOne('Job', array(
             'local' => 'id',
             'foreign' => 'store_id'));

        $timestampable0 = new Doctrine_Template_Timestampable(array(
             ));
        $this->actAs($timestampable0);
    }
}