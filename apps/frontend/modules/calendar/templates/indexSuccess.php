<?php  use_helper('Date');?>
<?php use_javascript('calendar.js') ?>


	<div id="calender_filter">
			<ul>
				<li  class="calender_filter_head">
					Filter
				</li>
				<li class="calender_filter_item calendar_type_1">
					<a class="calendar_type_button" href="<?php echo url_for('calendar/index/?period='.
					$period.'&next='.$next.'&user='.$userid.'&type=0') ?>">
						Alle</a>
				</li>
				<li class="calender_filter_item calendar_type_1_finshed">
					<a class="calendar_type_button" href="<?php echo url_for('calendar/index/?period='.
					$period.'&next='.$next.'&user='.$userid.'&type=1') ?>">
					Arbeit</a>
				</li>
				<li class="calender_filter_item calendar_type_2">
					<a class="calendar_type_button" href="<?php echo url_for('calendar/index/?period='.
					$period.'&next='.$next.'&user='.$userid.'&type=2') ?>">
					Krank</a>
				</li>
				<li class="calender_filter_item calendar_type_3">
					<a class="calendar_type_button " href="<?php echo url_for('calendar/index/?period='.
					$period.'&next='.$next.'&user='.$userid.'&type=3') ?>">
					Urlaub</a>
				</li>
			
	<?php if ( $sf_user->hasGroup('admin') OR $sf_user->hasGroup('supervisor')) : ?>
			
				<li class="calender_filter_item  calendar_user <?php if($userid == 0)  echo "button_selected" ?>">
					<a class="calendar_type_button " href="<?php echo url_for('calendar/index/?period='.$period.'&next='.$next.'&user=0') ?>">
					 Alle 
					</a>
				</li>	
			<?php foreach ($users as $user): ?>
				<li class="calender_filter_item calendar_user<?php if($userid == $user->getId())  echo " button_selected" ?> ">
					<a class='calendar_type_button' href="<?php echo url_for('calendar/index/?period='.$period.'&next='.$next.'&user='.$user->getId()) ?>">
					 <?php echo $user->getUsername() ?>	
					</a>
				</li>
		<?php endforeach ?>
		
	<?php endif ?>		
	</ul>

	</div>
<div id="calendar">	
	

<?php
$style_weekend = '<col class="table_weekend table_border_left"/>';
$style_workday = '<col class="table_workday table_border_left"/>';

echo '<table class="calendar"><colgroup>';

for ($i=0; $i < ($days > 7 ? 7:$days) ; $i++) { 
	if(strstr($calendar[$i]['w'],'So') OR strstr($calendar[$i]['w'],'Sa')) echo $style_weekend;
	else echo $style_workday;
}

echo '</colgroup>'; ?>
<thead>
	<tr>
			<td colspan="<?php echo ($days > 7 ? 7:$days) ?>" style="background-color: white;">
				<ul>	
					<li class="table_menu_left">
						<a class="button" 
							href="<?php echo url_for('calendar/index/?period='.
								$period.'&next='.($next - 1).'&user='.$userid) ?>">
							zurück	</a>
					</li>	
					<li class="table_menu_left">			
						<a class="button" href="<?php echo url_for('calendar/index/?period=5&next='.
							$next.'&user='.$userid) ?>">
					 	Monat</a>
					</li>	
					<li class="table_menu_left">
						<a class="button" href="<?php echo url_for('calendar/index/?period=1&next='.
									$next.'&user='.$userid) ?>">
						Woche</a>
					</li>	
					<li class="table_menu_left">	
						<a class="button" href="<?php echo url_for('calendar/index/?period=0&next='.
							$next.'&user='.$userid) ?>">
						Tag</a>
					</li>	
					<li class="table_menu_left">	
						<a class="button" href="<?php echo url_for('calendar/index/?period=1&next=0'.
									'&user='.$userid) ?>">
						Heute</a>
					</li>	
					<li class="table_menu_left">		
						<a class="button"  href="<?php echo url_for('calendar/index/?period='.
							$period.'&next='.($next + 1).'&user='.$userid) ?>">
						vor	</a>
					</li>
				</ul>
		
		</td>
	</tr>
</thead>	
<?php

for ($k=0; $k < $cols  ; $k++) {
	$offset = $k * 7; 
	$rows = 0;
	for ($i=0; $i < ($days > 7 ? 7:$days)  ; $i++) 
		{ 			
			if($rows < count($calendar[$i+$offset ]['jobs'])) $rows = count($calendar[$i+$offset]['jobs']);
				echo '<th '.($calendar[$i+$offset]['T'] ? 'class="calender_today"' : ' ' ).
				"colspan=\"1\" >".$calendar[$i+$offset]['w'].' '."</th>";
		}


echo "</tr>";

for ($i=0; $i < $rows; $i++) { 
	echo "<tr>";
	for ($j=0; $j < ($days > 7 ? 7:$days); $j++) { 
		//if(($i + $offset) < $cols-1){
		if( $calendar[$j+$offset]['jobs'][$i]->getId()) {
		$thermin = $calendar[$j+$offset]['jobs'][$i];	
		$job = $calendar[$j+$offset]['jobs'][$i]->getJob();
		echo '<td class="calendar_type_'.$thermin->getTaskTypeId();
	//	if($thermin->getScheduled() AND $thermin->getTaskTypeId() == 1)  echo '_finshed';
	//		echo ' calendar_button table_border_left" onclick="document.location = \''.
	//			url_for('task/edit?id='.$thermin->getId()).'\'"> ';
	//		echo $thermin->getTaskTypeId().'<br>';
	//		echo '</td><td class="calendar_type_'.$thermin->getTaskTypeId();
			if($thermin->getScheduled() AND $thermin->getTaskTypeId() == 1 ) echo '_finshed';
			echo ' table_border_right ';
			if ($thermin->getTaskTypeId() == 1) {
				echo 'calendar_button" onclick="document.location = \''.
					url_for('job/show?id='.$job->getId()).'\'">';
					echo format_date($thermin	->getStart(),'HH:mm').
						' - '.format_date($thermin	->getEnd(),'HH:mm');
					echo '<br>'.substr($job->getStore()->getCustomer()->getCompany(), 0, 15).
					($cols == 1? '<p>'.$job->getStore()->getStreet().
					'<br>'.$job->getStore()->getPostcode().' '.$job->getStore()->getCity().'</p>' : ' ' ).
					($days < 7? '<p>'.$job->getDescription().'</p>' : '<p>'.substr($job->getDescription(), 0, 20).
					' ... </p>' );	
			}
			else{
				echo '"><p>'.substr($thermin->getInfo(), 0, 20).'</p>';
		}
		echo '</td>';
		}
		else echo '<td colspan="1"> </td>';
	}
	echo "</tr>";
}
if( $rows == 0){
	echo '<tr>';
	for ($i=0; $i < 7; $i++) { 
		echo '<td colspan="1"> </td>';
	}
	echo '</tr>';
} 
}
	echo "</tbody></table>";
?>
</div>

<div id="open_job">
<table>
  <thead>
    <tr>
		<th class="calendar_open_jobs_head" colspan="3"> Offene Aufträge</th>
	</tr>
	</thead>
	<tbody class="calendar_open_jobs_body" >
	<?php foreach ($jobs as $job): ?>
	<tr class="table_item" 	onclick="document.location = '<?php if ($sf_user->hasPermission('Zuweisen')) echo url_for('task/new/?job='.$job->getId().'&type=0') ?>'">
		<td><?php echo $job->getId()?><br>
		Ende: <?php echo format_date($job->getEnd(),'dd.MM.') ?><br>
		Anfang: <?php echo format_date($job->getStart(),'dd.MM.') ?>
		</td>
		<td><p><?php echo $job->getStore()->getCustomer()->getCompany() ?></p>
		<p> <?php echo $job->getStore()->getStreet() ?><br>
		<?php echo $job->getStore()->getPostcode() ?><?php echo $job->getStore()->getCity() ?></p>
		<p>
			<?php echo substr($job->getDescription(), 0, 50) ?>
		</p>
		
		
    </tr>

    <?php endforeach; ?>
  </tbody>
</table>
</div>


