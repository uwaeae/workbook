<?php  use_helper('Date');?>
<?php use_javascript('calendar.js') ?>

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
						<?php include_partial('calnav', array('type' => 'week','users' => $users, 'userid' => $userid,'next' => $next)) ?>
		</td>
	</tr>
</thead>	
</tbody>
<tr>
		<th>Zeit</th>
	<?php foreach ($weekday as $day): ?>
		<th><?php echo $day['date'] ?></th>
	<?php endforeach ?>
	
	
</tr>
<td class="cal_week_col cal_timeline">
	<?php include_partial('timeline', array('time' => $timeline,'type' => 'user')) ?>
</td>

<?php foreach ($calendar as $day): ?>
	<td class="cal_week_col"	>
			<?php include_partial('task_users', array('day' => $day,'users' => $users)) ?>
		<?php // echo htmlspecialchars_decode($day) ?>
	</td>	
<?php endforeach ?>	

</tr>
</tbody>
</table>


<?php include_partial('openjob', array('jobs' => $jobs)) ?>
<?php include_partial('filter', array('type' => 'week','users' => $users, 'userid' => $userid,'next' => $next)) ?>


