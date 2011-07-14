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
				<?php include_partial('calnav', array('type' => 'month','users' => $users, 'userid' => $userid,'next' => $next)) ?>
		
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
<td class="cal_day_col cal_timeline">
	<?php echo htmlspecialchars_decode($timeline) ?>
</td>

<?php foreach ($week as $day): ?>
	<td class="cal_day_col"	>

		<?php echo htmlspecialchars_decode($day['task']) ?>
	</td>	
<?php endforeach ?>	

</tr>

<?php endforeach ?>
</tbody>
</table>
</div>

<?php include_partial('openjob', array('jobs' => $jobs)) ?>


