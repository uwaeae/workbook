<?php  use_helper('Date');?>
<?php use_javascript('calendar.js') ?>



<div id="calendar" >
<table class="calendar" style="width: 100%;">
<colgroup>
<col style="width: 10%" />
<col style="width: 90%">
</colgroup>
<thead>
	<tr>
		<td colspan="7" style="background-color: white;">
				<?php include_partial('calnav', array('type' => 'day','next' => $next)) ?>
		</td>
	</tr>
</thead>	
</tbody>
<tr >
	
		<th>Zeit</th>
	<?php foreach ($calendar as $day): ?>
		<th><?php echo $day['date'] ?></th>
	<?php endforeach ?>
</tr>
<td class="cal_day_col cal_timeline">
	<?php include_partial('timeline', array('time' => $timeline,'type' => 'large')) ?>
</td>	
<?php foreach ($calendar as $day): ?>
	<td class="cal_week_col"	>
			<?php include_partial('task_large', array('day' => $day['task'],'users' => $UserArray)) ?>
		<?php // echo htmlspecialchars_decode($day) ?>
	</td>	
<?php endforeach ?>
</tr>
</tbody>
</table>
</div>

<?php include_partial('openjob', array('jobs' => $jobs)) ?>
<?php include_partial('filterform', array('form' => $form , 'type' => 'day')) ?>

