<?php

/**
 * payroll actions.
 *
 * @package    workbook
 * @subpackage payroll
 * @author     Florian Engler
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class payrollActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
	
   		$this->taskmonth = Doctrine_Query::create()
					->select('MONTH(t.start) month')
					->from('Task t')
					->groupBy('month')
					->execute();
		$this->tasks = array();
		$this->worktime = 0;
		$this->overtime = 0;
		$this->sickness = 0;
		$this->holyday = 0;
		
		
		$t = Doctrine_Query::create()
					->select('t.*, ')
					->from('Task t')
					->leftJoin('TaskUser u')
					->where('u.user_id ='.$this->getUser()->getId())
					->andWhere('MONTH(t.start) = MONTH(NOW()) ')
					->execute();
					
	 foreach ($t as $task) {
	 	$tmp = array();
			$start = strtotime($task->getStart());
			$diff = date_diff(new DateTime($task->getStart()), new DateTime($task->getEnd()));
			if($diff->format('%d') > 0 ){
				$Stunden = 0;
				for($i = 1; $i < $diff->format('%d'); $i++)
				{
		   			$date = mktime(0, 0, 0, date("m",$start)  , date("d",$start)+ $i , date("Y",$start));	
					if(	date('w',$date) != 0 or date('w',$date) != 6)
					{
					$Stunden++;
					}
				}

				$Stunden = $Stunden * 8;

			}
			else {
				$Stunden =  date('H',strtotime($task->getEnd())) - date('H',strtotime($task->getStart()))  - $task->getOvertime();
			 	$Minuten = (date('i',strtotime($task->getEnd())) - date('i',strtotime($task->getStart())))	;
				$Minuten = round($Minuten / 30, 0) * 30;
				if($Minuten != 0) $Stunden += round($Minuten / 60,2);
			}

			$this->overtime +=  $task->getOvertime();
			switch ($task->getTaskTypeId()) {
				case '1':
			//	echo '<td>'.$Stunden.'</td><td>'.($task->getOvertime() == 0?' ':$task->getOvertime() ).'</td><td></td><td></td>';
					$tmp['worktime'] = $Stunden;
					$this->worktime += $Stunden;
					break;
				case '2':
				//	echo '<td></td><td>'.($task->getOvertime() == 0?' ':$task->getOvertime() ).'</td><td>'.$Stunden.'</td><td></td>';
				 	$tmp['holyday'] = $Stunden;
					$this->holyday += $Stunden;

					break;
				case '3':
				//	echo '<td></td><td>'.($task->getOvertime() == 0?' ':$task->getOvertime() ).'</td><td></td><td>'.$Stunden.'</td>';
					$tmp['sickness'] = $Stunden;
					$this->sickness += $Stunden;
					break;
			}
	
		$tmp['task'] = $task;
	
		$this->tasks[] = $tmp;
	
	 }
		
  }
	
  
}
