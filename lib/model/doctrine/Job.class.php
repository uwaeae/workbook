<?php

/**
 * Job
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    workbook
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Job extends BaseJob
{
	public function __toString()
	{
		return  substr($this->getStore()->getCustomer()->getCompany(),0,20).' - '.$this->getStore();
	}
	
	public function getCreator()
		{
		return 	Doctrine_Core::getTable('sfGuardUser')
							->find($this->getCreatedFrom() );
	}
	
	public function getUpdater()
		{
		return 	Doctrine_Core::getTable('sfGuardUser')
							->find($this->getUpdatedFrom() );
	}
	
	public function hasSheduledTasks()
	{
		$tasks = Doctrine_Query::create()
				->select('t.*')
				->from('task t')
				->where('job_id ='.$this->getId().' 
						AND scheduled IS TRUE ')
				->execute();
		if ($tasks->count() != 0) {
			return true;
		}
		else return false;
	}
	public function getOwnJobs($id){
		return 	Doctrine_Query::create()
            	->select('j.*')
				->from('Job j')
				/*->where('j.id IN (select job_id from task 
									where job_id IS NOT NULL 
									AND scheduled IS TRUE 
									GROUP BY job_id)')*/
				->leftJoin('j.Tasks t')
				->innerJoin('t.TaskUser u ON t.id = u.task_id AND u.user_id ='.$id )
				->orderby('j.end');
		
	}
	public function getOpenJobs(){
		return Doctrine_Query::create()
        	->select('j.*')
			->from('Job j')
			/*->where('j.id NOT IN (select job_id from task 
				where job_id IS NOT NULL
				AND scheduled IS NOT NULL
				GROUP BY job_id)')*/
			->leftJoin('j.Tasks t')
			->where('t.scheduled IS null OR FALSE')
			->orderby('j.end');
		
	}
	public function getSheduledJobs(){
		return 	Doctrine_Query::create()
            	->select('j.*')
				->from('Job j')
				/*->where('j.id IN (select job_id from task 
									where job_id IS NOT NULL 
									AND scheduled IS TRUE 
									GROUP BY job_id)')*/
				->leftJoin('j.Tasks t')
				->where('t.scheduled IS TRUE')
				->orderby('j.end');
		
	}
	public function getWorkedJobs(){
		return  Doctrine_Query::create()
			->select('j.*')
			->from('Job j')
			->leftJoin('j.Tasks t')
			->where('t.scheduled IS NOT TRUE')
			->andWhere('j.job_state_id = 1')
			->leftJoin('j.Invoices i')
			->andWhere('i.id is null   ')
			->orderby('j.end');
		
		
	}
	public function getFinishedJobs(){
			return  Doctrine_Query::create()
				->select('j.*')
				->from('Job j')
				->leftJoin('j.Tasks t')
				->where('t.scheduled IS NOT TRUE')
				->andWhere('j.job_state_id = 2')
				->leftJoin('j.Invoices i')
				->andWhere('i.id is null   ')
				->orderby('j.end');
		
		
	}
	public function getCompletedJobs(){
		return  Doctrine_Query::create()
			->select('j.*')
			->from('Job j')
			->leftJoin('j.Tasks t')
			->where('t.scheduled IS NOT TRUE')
			->andWhere('j.job_state_id = 2')
			->leftJoin('j.Invoices i')
			->andWhere('i.id is not null   ')
			->orderby('j.end');
		
	}

	
	
	
	
}
