<?php  use_helper('Date');?>
<?php use_javascript('calendar.js') ?>
<div id="calendar">
<table class="calendar">
	
<colgroup>
	<col class="cal_col_timeline" />
	<?php foreach ($weekday as $day): ?>
		<col class=" 
		<?php if($day['today']) echo 'cal_col_today '?>
		<?php echo ((($day['weekday']%2) != 1)? 'cal_col_even': 'cal_col_odd') ?>
		" />
	<?php endforeach ?>

</colgroup>
<thead>
	<tr>
			<td colspan="7" style="background-color: white;">
						<?php include_partial('calnav', array('type' => 'week','next' => $next)) ?>
		</td>
	</tr>
</thead>	
</tbody>

<?php foreach ( $UserArray as $user): ?>
<tr>
		<th>Zeit</th>
	<?php foreach ($calendar as $day): ?>
		<th><?php echo $day['date'] ?></th>
	<?php endforeach ?>
	
	
</tr>
<td class="cal_week_col cal_timeline">
	<?php include_partial('timeline', array('time' => $timeline,'type' => 'user')) ?>
</td>

<?php foreach ($calendar as $day): ?>
	<td class="cal_week_col"	>
		
			<?php include_partial('task_users', array('day' => $day['task'],'user' => $user,'style'=> 'width:'.round(100 / count($UserArray)))) ?>
		<?php // echo htmlspecialchars_decode($day) ?>
		<div class="cal_user_day"  >
		</div>
	</td>	
<?php endforeach ?>	

</tr>
<?php endforeach ?>
</tbody>
</table>
</div>

<?php include_partial('openjob', array('jobs' => $jobs)) ?>
<?php include_partial('filterform', array('form' => $form , 'type' => 'week')) ?>


