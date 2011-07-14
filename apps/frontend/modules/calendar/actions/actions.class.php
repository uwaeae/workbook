<?php

/**
 * calendar actions.
 *
 * @package    workbook
 * @subpackage calendar
 * @author     Florian Engler
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class calendarActions extends sfActions
{
	
	public function preExecute()
	{
		$this->calendar = array();
		$this->weekday = array();
		$this->makeWeekdays();
		$this->users = Doctrine_Query::create()
					->select('*')
					->from('sfGuardUser')
					->execute();
		$this->TaskType = Doctrine_Query::create()
					->select('*')
					->from('TaskType')
					->execute();
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
	
	protected function getTaskDay($offset, $type = 0, $userid = 0)
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
					
		if ($userid != 0) {
							$query->innerJoin('t.TaskUser t2 on  (t2.task_id = t.id  and t2.user_id = '.$userid.') ');
				}
		if ($type != 0) {
					$query->andWhere('t.task_type_id = '.$type);
			}
			
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

	$this->users = Doctrine_Query::create()
				->select('*')
				->from('sfGuardUser')
				->execute();
				
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



			if($request->hasParameter('next')){
				 $this->next =  $request->getParameter('next'); 
				}
			else {
					$this->next = 0;
				}

			if(	$request->hasParameter('user') 
				AND  $this->getUser()->hasGroup('admin') 
				OR $this->getUser()->hasGroup('supervisor') ){	
						$this->userid =  $request->getParameter('user'); 
					}	
			else $this->userid = $this->getUser()->getID();

			if($request->hasParameter('type')){	
					$this->type =  $request->getParameter('type'); 
				}
			else{
					$this->type = 0;
				}
			$this->timeline = $this->renderTimeline();
			$next =  $this->days * $this->next  - ( date('j') ) - ( date('w',mktime(0, 0, 0, date("m")  , date("d") - date('j') , date("Y")))) ;
			
			
			
			for ($i=0 ; $i < ($this->days / 7) ; $i++) { 
				$this->calendar[$i] = array();
				for ($j=1; $j < 8 ; $j++) { 
					$date = mktime(0, 0, 0, date("m")  , date("d")+ ( ($i * 7 ) + $j ) + $next, date("Y"));
					$this->calendar[$i][$j]['weekday'] = date('w');
					$this->calendar[$i][$j]['today'] = date('z') == date('z',$date);
					$this->calendar[$i][$j]['date'] = $this->tag[(date('w',$date))].' '.date("d.m.",$date);
					$this->calendar[$i][$j]['task'] = $this->renderDay($this->getTaskDay(( $i * $j ) + $next,$this->type,$this->userid));
				}
			}


	
	
	}
	
	public function executeWeek(sfWebRequest $request)
	{
			$this->days = 7;
		//Wochentags verschiebung auf anfang der woche also das das erste Element im Claendar der Montag ist
	
	

		if($request->hasParameter('next')){
			 $this->next =  $request->getParameter('next'); 
			}
		else {
				$this->next = 0;
			}
	
		if(	$request->hasParameter('user') 
			AND  $this->getUser()->hasGroup('admin') 
			OR $this->getUser()->hasGroup('supervisor') ){	
					$this->userid =  $request->getParameter('user'); 
				}	
		else $this->userid = $this->getUser()->getID();

		if($request->hasParameter('type')){	
				$this->type =  $request->getParameter('type'); 
			}
		else{
				$this->type = 0;
			}
		$this->timeline = $this->renderTimeline();
		$next =  $this->days * $this->next  - ( date('w') - 1);
		for ($i=0; $i < $this->days ; $i++) { 
			$date = mktime(0, 0, 0, date("m")  , date("d")+ $i + $next, date("Y"));
			$this->weekday[$i]['weekday'] = date('w');
			$this->weekday[$i]['today'] = date('z') == date('z',$date);
			$this->weekday[$i]['date'] = $this->tag[(date('w',$date))].' '.date("d.m.",$date);
			$this->calendar[$i] = $this->renderDay($this->getTaskDay($i + $next,$this->type,$this->userid));
		}
		
	
			
			
	}

	public function executeDay(sfWebRequest $request)
	  {

		$this->days = 1;
	
		if($request->hasParameter('next')){
			 $this->next =  $request->getParameter('next'); 
			}
		else {
				$this->next = 0;
			}

		if(	$request->hasParameter('user') 
			AND  $this->getUser()->hasGroup('admin') 
			OR $this->getUser()->hasGroup('supervisor') ){	
					$this->userid =  $request->getParameter('user'); 
				}	
		else $this->userid = $this->getUser()->getID();

		if($request->hasParameter('type')){	
				$this->type =  $request->getParameter('type'); 
			}
		else{
				$this->type = 0;
			}
			
		
		$date = mktime(0, 0, 0, date("m")  , date("d")+ $this->next, date("Y"));
		$this->weekday['today'] = date('z') == date('z',$date);
		$this->weekday['date'] = $this->tag[(date('w',$date))].' '.date("d.m.",$date);
		$this->calendar = $this->renderDay($this->getTaskDay( $this->next,$this->type,$this->userid));
		$this->timeline = $this->renderTimeline();
		
	
	}
	
	protected function renderTimeline()
	{
			$output = '<table border="0" class="cal_table">';
			for ($i=0; $i < 24  ; $i++) { 
			$output .= '<tr class="cal_timerow_'.(($i%2) == 1? 'even': 'odd').'" > ';
			$output .= '<td>'.$i.':00</td>';
			$output .= '</tr> ';
			}
			$output .= 	'</table></div>';
			return $output;
	}
		
		protected function renderDay($tasks)
		  {
			$daytime = array();	
			foreach ($tasks as $task) {
				$daytime[date('G',strtotime($task->getStart()))][] = $task;
			}
			for ($i=0; $i < 24  ; $i++) { 
			$output[$i] = array();
			
			if(isset($daytime[$i])) foreach ($daytime[$i] as $task) {
				$out = array();
				$end = date('G',strtotime($task->getEnd()));
				$start = date('G',strtotime($task->getStart()));
				$out['duration'] = $end - $start;
				$out['task'] = $task;
				
				$output[$i][] = $out;
				} 	
			}
			
			return $output;
			
		  }
		
		protected function renderTask($task,$style = 9){
			
			
				
				return $output;
		}


		
		
		public function postExecute()
		  {
		    $this->getUser()->setAttribute('calendar',
								array('next'=> $this->next,'user'=> $this->userid));
			$routing = $this->getContext()->getRouting();
			$this->getUser()->setAttribute('back',$routing->getCurrentInternalUri());
		  }

}
