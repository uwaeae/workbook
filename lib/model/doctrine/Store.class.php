<?php

/**
 * Store
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    workbook
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Store extends BaseStore
{
	public function __toString()
	{
		return  substr($this->getCustomer()->getCompany(),0,20)
				.($this->getNumber() ==  0? ' ': ' - '.$this->getNumber().' - ')
				.str_pad($this->getPostcode(),5,"0", STR_PAD_LEFT)
				.' '.$this->getCity()
				.' '.$this->getStreet();
	}
	static public function retrieveForSelect($q, $limit, $customer = NULL)
	{
		$query = Doctrine_Core::getTable('Store')->createQuery('s');
		if($customer) $query->innerJoin('s.Customer c WITH c.id = '.$customer );
		
		if(is_numeric($q)) $query->where(" s.number LIKE '$q%'");
		else if(strlen($q) > 1) $query->where("s.street like '$q%' ");
		
		$stores = array();
		foreach ($query->execute() as $store){
				$stores[$store->getId()] = (string) $store;
			}
		return $stores;
	}
	
}
