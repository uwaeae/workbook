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

protected function getMonth($number){
	
	$month = array();
		$month[1] = 'Januar';
		$month[2] = 'Februar';
		$month[3] = 'März';
		$month[4] = 'April';
		$month[5] = 'Mai';
		$month[6] = 'Juni';
		$month[7] = 'Juli';
		$month[8] = 'August';
		$month[9] = 'September';
		$month[10] = 'Oktober';
		$month[11] = 'November';
		$month[12] = 'Dezember';
	return $month[$number];
	
	
}

protected function makeNavForm()
  {
	$form = new sfForm();
	$month = Doctrine_Query::create()
				->select('MONTH(t.start) month')
				->from('Task t')
				->groupBy('month')
				->execute();
	$this->taskmonth = array();
	foreach ($month as $m) {
		$this->taskmonth[$m->month] = $this->getMonth($m->month);
	
	}
	
	$form->setWidget('month',new sfWidgetFormChoice(array(
			'choices' => $this->taskmonth,
			'expanded' => true,
	      	'multiple'	=> false,
	 		 )));
	$form->setDefault('month', date('n'));
	
	
	$form->setWidget('user',new sfWidgetFormDoctrineChoice(array(
	      	'model' => 'sfGuardUser', 
	      	'add_empty' => false,
			'expanded' => true,
	      	'multiple'	=> false )));
	$form->setDefault('user', $this->getUser()->getId());
	

	return $form;
	
  }

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
	
   		
		$month = Doctrine_Query::create()
					->select('MONTH(t.start) month')
					->from('Task t')
					->groupBy('month')
					->execute();
		$this->taskmonth = array();
		foreach ($month as $m) {
			$this->taskmonth[$m->month] = array();
			$this->taskmonth[$m->month]['nr'] = $m->month ;
			$this->taskmonth[$m->month]['month'] = $this->getMonth($m->month);
		
		}
		
		$this->tasks = array();
		$this->worktime = 0;
		$this->overtime = 0;
		$this->sickness = 0;
		$this->holyday = 0;
		
		
		$query = Doctrine_Query::create()
					->select('t.*, ')
					->from('Task t')
					->leftJoin('TaskUser u')
					->where('u.user_id ='.$this->getUser()->getId());
		if($request->hasParameter('month'))
				$t = $query->andWhere('MONTH(t.start) = '.$request->getParameter('month'))
					->execute();
		else $t = $query->andWhere('MONTH(t.start) = MONTH(NOW()) ')
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
		$this->form = $this->makeNavForm();
	
	 }
		
  }

  
}
