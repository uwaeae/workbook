<?php

/**
 * JobTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class JobTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object JobTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Job');
    }

	public static function getSimilarOpenJobs($postcode,$range,$id = 0,$store)
    {
        return Doctrine_Query::create()
					->select('*')
					->from('Job j')
					->innerJoin('j.Store s WITH s.postcode between '.
					($postcode - $range).' and '.
					($postcode + $range).' AND s.id <> '.$store) 
					->where('j.job_state_id = 1')
					->andWhere('j.id <> '.$id)
					->orderby('j.end')
					->execute();
		
    }
public static function getStoreOpenJobs($id,$store)
    {
        return Doctrine_Query::create()
					->select('*')
					->from('Job j')
					->innerJoin('j.Store s WITH s.id ='.$store)
					->where('j.job_state_id = 1')
					->andWhere('j.id <>'.$id)
					->orderby('j.end')
					->execute();
		
    }
public static function getStoreOldJobs($id,$store)
	    {
	        return Doctrine_Query::create()
						->select('*')
						->from('Job j')
						->innerJoin('j.Store s WITH s.id ='.$store)
						->where('j.job_state_id = 2')
						->andWhere('j.id <>'.$id)
						->orderby('j.end')
						->execute();

	    }

	public function getOwnJobs($id){
		return 	Doctrine_Query::create()
        ->select('j.*')
				->from('Job j')
				->leftJoin('j.Tasks t')
				->innerJoin('t.TaskUser u ON t.id = u.task_id AND u.user_id ='.$id )
				->andWhere('j.job_state_id < 2')
				->orderby('j.end');
		
	}
    public function getCountOwnJobs($id){
        return 	Doctrine_Query::create()
            ->select('j.*')
            ->from('Job j')
            ->leftJoin('j.Tasks t')
            ->innerJoin('t.TaskUser u ON t.id = u.task_id AND u.user_id ='.$id )
            ->andWhere('j.job_state_id < 2')
            ->orderby('j.end')
            ->execute()->count();

    }


	public function getOpenJobs(){
		return Doctrine_Query::create()
        	->select('j.*')
			->from('Job j')
			->leftJoin('j.Tasks t')
			->where('t.scheduled IS null OR FALSE')
			->andWhere('j.job_state_id < 2')
			->orderby('j.end');
		
	}
    public function getCountOpenJobs(){
        return Doctrine_Query::create()
            ->select('j.*')
            ->from('Job j')
            ->leftJoin('j.Tasks t')
            ->where('t.scheduled IS null OR FALSE')
            ->andWhere('j.job_state_id < 2')
            ->orderby('j.end')
            ->execute()->count();

    }
// TODO zugeordnete Jobs noch in die Übersihct
    public function getAssignedJobs(){
        return 	Doctrine_Query::create()
            ->select('j.*')
            ->from('Job j')
            ->leftJoin('j.Tasks t')
            ->where('t.scheduled IS TRUE')
            ->andWhere('j.job_state_id = 1')
            ->orderby('j.end');

    }





	public function getSheduledJobs(){
		return 	Doctrine_Query::create()
            	->select('j.*')
				->from('Job j')
				->leftJoin('j.Tasks t')
        ->leftJoin('j.JobUser ju')
        ->where('t.scheduled IS TRUE OR j.id = ju.job_id')
				->andWhere('j.job_state_id = 1')
				->orderby('j.end');
		
	}
    public function getCountSheduledJobs(){
        return 	Doctrine_Query::create()
            ->select('j.*')
            ->from('Job j')
            ->leftJoin('j.Tasks t')
            ->leftJoin('j.JobUser ju ')
            ->where('t.scheduled IS TRUE AND j.job_state_id = 1')
            ->orWhere('j.id = ju.job_id')
            ->orderby('j.end')
            ->execute()->count();

    }

  public function getSheduledJobsByUser($UserID){
        return 	Doctrine_Query::create()
            ->select('j.*')
            ->from('Job j')
            ->leftJoin('j.Tasks t')
            ->leftJoin('t.TaskUser u ON t.id = u.task_id AND u.user_id ='.$UserID )
            ->leftJoin('j.JobUser ju ON j.id = ju.job_id AND ju.user_id ='.$UserID )
            ->where('t.scheduled IS TRUE')
            ->andWhere('j.job_state_id = 1')
            ->andWhere('ju.user_id ='.$UserID.' OR u.user_id ='.$UserID)
            ->orderby('j.end');

  }

    public function getCountSheduledJobsByUser($UserID){
        return 	Doctrine_Query::create()
            ->select('j.*')
            ->from('Job j')
            ->leftJoin('j.Tasks t')
            ->leftJoin('t.TaskUser u ON t.id = u.task_id AND u.user_id ='.$UserID )
            ->leftJoin('j.JobUser ju ON j.id = ju.job_id AND ju.user_id ='.$UserID )
            ->where('t.scheduled IS TRUE')
            ->andWhere('j.job_state_id = 1')
            ->andWhere('ju.user_id ='.$UserID.' OR u.user_id ='.$UserID)
            ->orderby('j.end')->execute()->count();

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
    public function getCountWorkedJobs(){
        return  Doctrine_Query::create()
            ->select('j.*')
            ->from('Job j')
            ->leftJoin('j.Tasks t')
            ->where('t.scheduled IS NOT TRUE')
            ->andWhere('j.job_state_id = 1')
            ->leftJoin('j.Invoices i')
            ->andWhere('i.id is null   ')
            ->orderby('j.end')
            ->execute()->count();


    }

    public function getWorkedJobsByUser($UserID){
        return  Doctrine_Query::create()
            ->select('j.*')
            ->from('Job j')
            ->leftJoin('j.Tasks t')
            ->innerJoin('t.TaskUser tu ON t.id = tu.task_id AND tu.user_id ='.$UserID )

            ->where('t.scheduled IS NOT TRUE')
            ->andWhere('j.job_state_id = 1')
            ->leftJoin('j.Invoices i')
            ->andWhere('i.id is null   ')
            ->orderby('j.end');


    }

    public function getCountWorkedJobsByUser($UserID){
        return  Doctrine_Query::create()
            ->select('j.*')
            ->from('Job j')
            ->leftJoin('j.Tasks t')
            ->innerJoin('t.TaskUser u ON t.id = u.task_id AND u.user_id ='.$UserID )
            ->where('t.scheduled IS NOT TRUE')
            ->andWhere('j.job_state_id = 1')
            ->leftJoin('j.Invoices i')
            ->andWhere('i.id is null   ')
            ->orderby('j.end')
            ->execute()->count();


    }




	public function getFinishedJobs(){
			return  Doctrine_Query::create()
				->select('j.*')
				->from('Job j')
				->where('j.job_state_id = 2')
				->leftJoin('j.Invoices i')
				->andWhere('i.id is null ')
				->orderby('j.id');
		
		
	}
    public function getCountFinishedJobs(){
        return  Doctrine_Query::create()
            ->select('j.*')
            ->from('Job j')
            ->where('j.job_state_id = 2')
            ->leftJoin('j.Invoices i')
            ->andWhere('i.id is null ')
            ->orderby('j.id')->execute()->count();


    }
	public function getCompletedJobs(){
		return  Doctrine_Query::create()
			->select('j.*')
			->from('Job j')
			->andWhere('j.job_state_id = 2')
			->leftJoin('j.Invoices i')
			->andWhere('i.id is not null   ')
			->orderby('j.end');
		
	}

    public function getCountCompletedJobs(){
        return  Doctrine_Query::create()
            ->select('COUNT(j.id)')
            ->from('Job j')
            ->andWhere('j.job_state_id = 2')
            ->leftJoin('j.Invoices i')
            ->andWhere('i.id is not null   ')
            ->orderby('j.end')
            ->execute()->count();

    }



	 
}