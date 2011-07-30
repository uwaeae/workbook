<?php

/**
 * calendar actions.
 *
 * @package    workbook
 * @subpackage calendar
 * @author     Florian Engler
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class calendarComponents extends sfComponents
{
  public function executeSmall()
  {
    
  }
}


class calendarActions extends sfActions
{
	
	public function preExecute()
	{
		$this->calendar = array();
		$this->weekday = array();
		$this->makeWeekdays();
	
	
		$this->jobs = Doctrine_Query::create()
					->select('j.*')
					->from('Job j')
					->where('j.id NOT IN (select job_id from task where job_id IS NOT NULL GROUP BY job_id)')
					->execute();
		
	}
	
	protected function makeWeekdays()
	  {
		
		$this->tag = array();
		$this->tag[0] = "So";
		$this->tag[1] = "Mo";
		$this->tag[2] = "Di";
		$this->tag[3] = "Mi";
		$this->tag[4] = "Do";
		$this->tag[5] = "Fr";
		$this->tag[6] = "Sa";
	
	  }
	protected function getUserArray()
	  {
			$query = Doctrine_Query::create()
							->select('u.id')
							->from('sfGuardUser u');
		
			if($this->getUser()->hasGroup('admin') 
							OR $this->getUser()->hasGroup('supervisor')){
				if(isset($this->Users)) 
					$this->UserArray = $query->where('u.id IN ('.implode(",", $this->Users).')')->execute();
				else  
					$this->UserArray = $query->execute();
				}
			else {
				$this->UserArray = $query->where('u.id = '.$this->getUser()->getID())->execute();
			}

	  }
	
	
	
	protected function setOptions(sfWebRequest $request)
	  {
		if($request->isMethod(sfRequest::POST))  {
			$this->TaskType = $request->getParameter('type');
			$this->Users = $request->getParameter('user');
			$this->getUserArray();
		} else {
			
			if($this->getUser()->hasAttribute('calendar')){
				$attribute = $this->getUser()->getAttribute('calendar');
				$this->Users = $attribute['user'];
				$this->TaskType = $attribute['type'];
				$this->getUserArray();
			} else {
				$TT = Doctrine_Query::create()
								->select('t.id')
								->from('TaskType t')
								->execute();
				$this->TaskType = array();
				foreach ( $TT as $task) {
					$this->TaskType[] = $task->getId();
				}
				
				$this->getUserArray();
				$this->Users = array();
				foreach ( $this->UserArray as $user) {
					$this->Users[] = $user->getId();
				}
			}
				
		}
		
		if($request->hasParameter('next')){
			 $this->next =  $request->getParameter('next'); 
			}
		else {
			    if($this->getUser()->hasAttribute('calendar')){
					$options = $this->getUser()->getAttribute('calendar');	
					$this->next = $options['next'];
					}
				else $this->next = 0;
			}
		}
	
	
	protected function makeFilterForm()
	  {
		$form = new sfForm();
	
		$form->setWidget('type',new sfWidgetFormDoctrineChoice(array(
		      	'model' => 'tasktype', 
		      	'add_empty' => false,
				'expanded' => true,
		      	'multiple'	=> true
		 		 )));
		$form->setDefault('type', $this->TaskType);
		
		
		$form->setWidget('user',new sfWidgetFormDoctrineChoice(array(
		      	'model' => 'sfGuardUser', 
		      	'add_empty' => false,
				'expanded' => true,
		      	'multiple'	=> true )));
		$form->setDefault('user', $this->Users);
		
	
		return $form;
		
	  }
	
	protected function getTaskDay($offset)
	  {
		$date_day = date("d")+$offset;
		$day_beginn = "'".date('y-m-d H:i:s',mktime(0,0,0,date("m"),$date_day,date("Y")))."'";
		$day_end = "'".date('y-m-d H:i:s',mktime(23,59,59,date("m"),$date_day,date("Y")))."'";
		$day_day = "'".date('y-m-d',mktime(0,0,0,date("m"),$date_day,date("Y")))."'";
		$query = Doctrine_Query::create()
					->select('t.*')
					->from('Task t')
					->where("t.start between ".$day_beginn." AND ".$day_end." OR ".
					"t.end between ".$day_beginn." AND ".$day_end." OR ".
					$day_day." BETWEEN t.start AND t.end" 
					)	
					->orderby('t.task_type_id DESC, t.start');
					
		$userJoin = 't.TaskUser t2 on  ( t2.task_id = t.id AND t2.user_id IN ('.implode(",", $this->Users).'))';
		$query->innerJoin($userJoin);	
		$query->andWhere( 't.task_type_id IN ('.implode(",", $this->TaskType).')');
				
			
		
		return $query->execute();
	  }
	
	
  public function executeIndex(sfWebRequest $request)
  {
	
	$this->days = 1;
	if($request->hasParameter('period') )
		{
		$this->period = $request->getParameter('period');
			if (	$this->period == 0) $this->days = 1;
			else $this->days = $this->period * 7;
		}
	else 
		{
		$this->days = 1;
		$this->period = 0;
		}
	
	if($request->hasParameter('next'))
		{
		 $this->next =  $request->getParameter('next'); 
		}
	else 
		{
		$this->next = 0;
		}
	
	if($request->hasParameter('user') 
		AND  $this->getUser()->hasGroup('admin') 
		OR $this->getUser()->hasGroup('supervisor') )
		{	
		$this->userid =  $request->getParameter('user'); 
		}	
	else $this->userid = $this->getUser()->getID();

	if($request->hasParameter('type'))
		{	
		 $this->type =  $request->getParameter('type'); 
		}
	else {
		$this->type = 0;
		}
	$this->calendar = array();

	
				
	$this->TaskType = Doctrine_Query::create()
						->select('*')
						->from('TaskType')
						->execute();
    $this->jobs = Doctrine_Query::create()
				->select('j.*')
				->from('Job j')
				->where('j.id NOT IN (select job_id from task where job_id IS NOT NULL GROUP BY job_id)')
				->execute();
				

	
	$next = ($this->days > 2 ? $this->days * $this->next  - ( date('w') - 1) :  $this->next );
	for ($i=0; $i < ($this->days) ; $i++) { 
		
		$date = mktime(0, 0, 0, date("m")  , date("d")+ $i + $next, date("Y"));
		$this->calendar[$i] = array();
		$this->calendar[$i]['T'] = date('z') == date('z',$date);
		$this->calendar[$i]['w'] = $this->tag[(date('w',$date))].' '.date("d.m.",$date);
		$day_beginn = "'".date('y-m-d H:i:s',mktime(0,0,0,date("m"),date("d")+$i + $next,date("Y")))."'";
		$day_end = "'".date('y-m-d H:i:s',mktime(23,59,59,date("m"),date("d")+$i + $next,date("Y")))."'";
		$day_day = "'".date('y-m-d',mktime(0,0,0,date("m"),date("d")+$i + $next,date("Y")))."'";
		$query = Doctrine_Query::create()
					->select('t.*')
					->from('Task t')
					->where("t.start between ".$day_beginn." AND ".$day_end." OR ".
					"t.end between ".$day_beginn." AND ".$day_end." OR ".
					$day_day." BETWEEN t.start AND t.end" 
					)	
					->orderby('t.task_type_id DESC, t.start');
		if ($this->userid > 0) {
				$query->innerJoin('t.TaskUser t2 on  (t2.task_id = t.id  and t2.user_id = '.$this->userid.') ');
		}
		if ($this->type != 0) {
			$query->andWhere('t.task_type_id = '.$this->type);
		}
		$this->calendar[$i]['jobs'] = $query->execute();
		
		
		
		
		
		
	}
	$this->rows = 0;
	$this->cols = round(count($this->calendar)/ 7);
	if ($this->period == 0) {
	$this->cols = 1;
	}


	}
	
	public function executeMonth(sfWebRequest $request)
	{
				$this->days = 31;
			//Wochentags verschiebung auf anfang der woche also das das erste Element im Claendar der Montag ist

			$this->setOptions( $request);
			
			$this->timeline = $this->renderTimeline(8,18);
			$next =  $this->days * $this->next  - ( date('w') - 1);
			
			
			for ($i=0 ; $i < ($this->days / 7) ; $i++) { 
				
				$this->calendar[$i] = $this->renderCalendar(7,($i * 7 ) + $next,8,18);
			}
				$this->form = $this->makeFilterForm();
			$this->setBack('calendar/month/?&next='.$this->next.'&user='.$this->userid);	
			$this->getUser()->setAttribute('calendar',
								array('next'=> $this->next,'type'=> $this->TaskType,'user' => $this->Users));	
	}

public function executeWeek(sfWebRequest $request)
	{
		
		$this->days = 7;
		$this->setOptions( $request);
		//Wochentags verschiebung auf anfang der woche also das das erste Element im Claendar der Montag ist
		$next =  $this->days * $this->next  - ( date('w') - 1);
		$this->calendar = $this->renderCalendar($this->days,$next,7,22);
		$this->timeline = $this->renderTimeline(7,22);
		$this->form = $this->makeFilterForm();
		$this->setBack('calendar/week/?&next='.$this->next);
		$this->getUser()->setAttribute('calendar',
							array('next'=> $this->next,'type'=> $this->TaskType,'user' => $this->Users));
		   //$this->setTemplate('table');
	}
	
public function executeDay(sfWebRequest $request)
	{
		$this->days = 1;
		$this->setOptions( $request);
		$this->timeline = $this->renderTimeline(7,22);
		$this->calendar = $this->renderCalendar($this->days,$this->next,7,22);
		$this->form = $this->makeFilterForm();
		$this->setBack('calendar/day/?&next='.$this->next);	
		$this->getUser()->setAttribute('calendar',
							array('next'=> $this->next,'type'=> $this->TaskType,'user' => $this->Users));
	}
public function executeSmall(sfWebRequest $request)
	{

		$this->days = 7;
		$this->setOptions( $request);
		//Wochentags verschiebung auf anfang der woche also das das erste Element im Claendar der Montag ist
		$next =  $this->days * $this->next  - ( date('w') - 1);
		$this->calendar = $this->renderCalendar($this->days,$next,7,22);
		$this->timeline = $this->renderTimeline(7,22);
		$this->form = $this->makeFilterForm();
		$this->setBack('calendar/week/?&next='.$this->next);
		$this->setLayout(false);
	}
	
	protected function renderCalendar( $days, $next = 0,$from = 0,$to = 24){
			$calendar = array();
		$date = mktime(0, 0, 0, date("m")  , date("d")+ $next, date("Y"));
			for ($i=0; $i < $days ; $i++) { 
				$date = mktime(0, 0, 0, date("m")  , date("d")+ $i + $next, date("Y"));
				$calendar[$i]['weekday'] = date('w');
				$calendar[$i]['today'] = date('z') == date('z',$date);
				$calendar[$i]['date'] = $this->tag[(date('w',$date))].' '.date("d.m.",$date);
				$calendar[$i]['task'] = $this->renderDay($this->getTaskDay($i + $next),$from,$to);
			}
		return $calendar;
	}
	
	
	protected function renderTimeline($from = 0,$to = 24)
	{
			$output = array();
			for ($i=$from; $i < $to  ; $i++) { 
			 $output[] = $i;
			}
			
			return $output;
	}
		
		protected function renderDay($tasks,$from = 0,$to = 24)
		  {
			
			
			$daytime = array();	
			foreach ($tasks as $task) {
				$daytime[date('G',strtotime($task->getStart()))][] = $task;
			}
			for ($i=$from; $i < $to  ; $i++) { 
			
			foreach ($this->UserArray  as $user) {
			
				
				$output[$user->getUsername()][$i] = array();
			
				if(isset($daytime[$i])) foreach ($daytime[$i] as $task) {
					foreach ($task->getUsers() as $u) {
						$out = array();
						$end = date('G',strtotime($task->getEnd()));
						$start = date('G',strtotime($task->getStart()));
						$out['duration'] = $end - $start;
						$out['task'] = $task;
						if($u->getUsername() == $user->getUsername() )
						$output[$u->getUsername()][$i][] = $out;
						}
					} 	
				
				
				}
			}
			return $output;
			
		  }
		
	
	protected function setBack($var){
			$routing = $this->getContext()->getRouting();
			$this->getUser()->setFlash('back',$var);
			$this->getUser()->setAttribute('back',$routing->getCurrentInternalUri());
			}
	
		
		public function postExecute()
		  {
		    $this->getUser()->setAttribute('calendar',
								array('next'=> $this->next,'type'=> $this->TaskType,'user' => $this->Users));
								
							$routing = $this->getContext()->getRouting();
			
							$this->getUser()->setAttribute('back',$routing->getCurrentInternalUri());
		  }

}
