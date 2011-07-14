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
	<?php echo htmlspecialchars_decode($timeline) ?>
</td>	
<td class="cal_day_col">
	<?php echo htmlspecialchars_decode($calendar) ?>
</td>	
</tr>
</tbody>
</table>


<?php include_partial('openjob', array('jobs' => $jobs)) ?>


