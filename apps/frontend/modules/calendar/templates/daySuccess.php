<?php  use_helper('Date');?>
<?php use_javascript('calendar.js') ?>




<table class="calendar"><colgroup>

</colgroup>
<thead>
	<tr>
		<td colspan="7" style="background-color: white;">
				<?php include_partial('calnav', array('type' => 'day','users' => $users, 'userid' => $userid,'next' => $next)) ?>
		</td>
	</tr>
</thead>	
</tbody>
<tr >
	
	<th colspan="2"><?php echo htmlspecialchars_decode($weekday['date']) ?></th>
</tr>
<td class="cal_day_col cal_timeline">
	<?php include_partial('timeline', array('time' => $timeline,'type' => 'large')) ?>
</td>	
<td class="cal_day_col">
	<?php include_partial('task_large', array('day' => $day,'users' => $UserArray)) ?>
</td>	
</tr>
</tbody>
</table>


<?php include_partial('openjob', array('jobs' => $jobs)) ?>
<?php include_partial('filterform', array('form' => $form , 'type' => 'week')) ?>

