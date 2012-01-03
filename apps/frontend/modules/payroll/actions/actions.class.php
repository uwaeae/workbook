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

protected function makeNavForm($user)
  {
	// Erweiterung um Jahr
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
	
	if ( $this->getUser()->hasPermission('admin')) {
	$form->setWidget('user',new sfWidgetFormDoctrineChoice(array(
	      	'model' => 'sfGuardUser', 
	      	'add_empty' => false,
			'expanded' => true,
	      	'multiple'	=> false )));
	$form->setDefault('user', $user);
	}

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
		
		$this->approach = 0;
		$this->worktime = 0;
		$this->overtime = 0;
    $this->correcttime = 0;
		$this->sickness = 0;
		$this->holyday = 0;
		
		$part = Doctrine_Core::getTable('Option')->getOptionByName('payroll_hour_split');
		$query = Doctrine_Query::create()
					->select('t.*, ')
					->from('Task t')
					->orderBy('t.start');
		
		if ( $this->getUser()->hasPermission('admin')) {
			$user = ($request->hasParameter('user')? $request->getParameter('user') : $this->getUser()->getId());
		} 
		else {
			$user = $this->getUser()->getId();
		}
					
		$query->where('t.id  IN ( select task_id from task_user where user_id = '.$user.')');
		$query->andWhere('t.scheduled is not TRUE');
		
		if($request->hasParameter('month'))
				$t = $query->andWhere('MONTH(t.start) = '.$request->getParameter('month'))
					->execute();
		else $t = $query->andWhere('MONTH(t.start) = MONTH(NOW()) ')
				->execute();
		$this->setBack('payroll/index/?user='.$user.($request->hasParameter('month')? '&month='.$request->getParameter('month'):''));			
	 
	foreach ($t as $task) {
	 	$tmp = array();
			$start = strtotime($task->getStart());
			// Stunden differenz zwischen anfang und ende der Arbeit berechnen
			$diff = date_diff(new DateTime($task->getStart()), new DateTime($task->getEnd()));
			$Tage = $diff->format('%d');
			$Stunden = $diff->format('%h'); 
			// Stunden Addierung wenn mehrere Tage gearbeitet wurde( kommt eingentlich nicht vor)
		
			// Minuten Berechnung in Stunden anteile
			$Minuten = $diff->format('%i'); 
			$Minuten = round($Minuten / $part, 0) * $part;
			if($Minuten != 0) $Stunden += round($Minuten / 60,2);
			
			if($diff->format('%d') > 0 ){
				 	$Stunden = 0;
				 	for($i = 0; $i <= $diff->format('%d'); $i++)
				 	{
				 			   			$date = mktime(0, 0, 0, date("m",$start)  , date("d",$start)+ $i , date("Y",$start));	
				 		if(	date('w',$date) != 0 AND date('w',$date) != 6 AND  !Doctrine_Core::getTable('Holiday')->isHoliday($date))
				 		{
				 		$Stunden++;
				 		}
				 	}
				 
				 	$Stunden = $Stunden * 8;
				 
				 }
				// else {
				// 	$Stunden =  date('H',strtotime($task->getEnd())) - date('H',strtotime($task->getStart()))  - $task->getOvertime() +$task->getCorrectionTime();
				//  	$Minuten = (date('i',strtotime($task->getEnd())) - date('i',strtotime($task->getStart())))	;

// Hier noch die Eintsllungsparameter für die Stunden berechnung einbauen
			// 		$Minuten = (date('i',strtotime($task->getEnd())) - date('i',strtotime($task->getStart())))	;
			// 		$Minuten = round($Minuten / $part, 0) * $part;
			// 		if($Minuten != 0) $Stunden += round($Minuten / 60,2);
			// 
			// 	
			// }

			$this->overtime +=  $task->getOvertime();
      $this->correcttime += $task->getCorrectionTime();
			$Stunden -= $task->getOvertime();
			switch ($task->getTaskTypeId()) {
				case '1': // Arbeitsstunden berechnung
			//	echo '<td>'.$Stunden.'</td><td>'.($task->getOvertime() == 0?' ':$task->getOvertime() ).'</td><td></td><td></td>';
					$Stunden = $Stunden - ($task->getBreak() * 0.25) + $task->getCorrectionTime();
					$tmp['worktime'] = $Stunden;
					$this->worktime += $Stunden;
					$tmp['approach'] = $task->getApproach() * 0.25;
					$this->approach += $task->getApproach() * 0.25;
					break;

				case '2': // Krankheit
						$tmp['sickness'] = $Stunden;
						$this->sickness += $Stunden;
					break;
				case '3': //Urlaubsbrrechung
						$tmp['holyday'] = $Stunden;
						$this->holyday += $Stunden;
					break;
				default : //buero und sonstiges
					$Stunden = $Stunden - ($task->getBreak() * 0.25) + $task->getCorrectionTime();
					$tmp['worktime'] = $Stunden;
					$this->worktime += $Stunden;
					$tmp['approach'] = $task->getApproach() * 0.25;
					$this->approach += $task->getApproach() * 0.25;
					break;	
			}
	
		$tmp['task'] = $task;
	
		$this->tasks[] = $tmp;
	
	
	 }
		$this->form = $this->makeNavForm($user);
		$this->TaskType  = Doctrine_Query::create()
						->select('t.*, ')
						->from('TaskType t')
						->orderBy('t.name')
						->execute();
			
  }


protected function setBack($var){
		$routing = $this->getContext()->getRouting();
		$this->getUser()->setFlash('back',$var);
		$this->getUser()->setAttribute('back',$var);
		}




  
}
