<?php

/**
 * EntryTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class EntryTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object EntryTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Entry');
    }
}