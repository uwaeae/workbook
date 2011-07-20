<?php  use_helper('Date');?>
<?php use_javascript('calendar.js') ?>

<div id="calendar">
<table class="calendar">
	
<colgroup>
	<col class="cal_col_timeline" />
		<col class="cal_col_even" />
		<col class="cal_col_odd" />
		<col class="cal_col_even" />
		<col class="cal_col_odd" />
		<col class="cal_col_even" />
		<col class="cal_col_odd" />
		<col class="cal_col_even" />
</colgroup>
<thead>
	<tr>
			<td colspan="7" style="background-color: white;">
				<?php include_partial('calnav', array('type' => 'month','next' => $next)) ?>
		
		</td>
	</tr>
</thead>	
</tbody>


<?php foreach ($calendar as $week): ?>
	<tr>
		<th>Zeit</th>
	<?php foreach ($week as $day): ?>
		<th><?php echo $day['date'] ?></th>
	<?php endforeach ?>
	</tr>
		<td class="cal_day_col cal_timeline_small">
		<?php include_partial('timeline', array('time' => $timeline,'type' => 'small')) ?>
		</td>
	<?php foreach ($week as $day): ?>
		<td class="cal_day_col"	>
			<?php include_partial('task_small', array('day' => $day['task'],'users' => $UserArray)) ?>
		</td>	
		<?php endforeach ?>	
		<td class="cal_day_col cal_timeline_small">
		<?php include_partial('timeline', array('time' => $timeline,'type' => 'small')) ?>
		</td>
	</tr>
<?php endforeach ?>

</tbody>
</table>
</div>
<?php include_partial('openjob', array('jobs' => $jobs)) ?>
<?php include_partial('filterform', array('form' => $form , 'type' => 'month')) ?>


