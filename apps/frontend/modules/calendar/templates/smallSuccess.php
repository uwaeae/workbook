<?php  use_helper('Date');?>
<?php use_javascript('calendar.js') ?>
<div id="calendar">
<table class="calendar">

<tr>
		<th>Zeit</th>
	<?php foreach ($calendar as $day): ?>
		<th><?php echo $day['date'] ?></th>
	<?php endforeach ?>
	
	
</tr>
<td class="cal_small cal_timeline">
	<?php include_partial('timeline', array('time' => $timeline,'type' => 'micro','size' => 5)) ?>
</td>

<?php foreach ($calendar as $day): ?>
	<td class="cal_week_col"	>
			<?php include_partial('small', array('day' => $day['task'],'users' => $UserArray)) ?>
		<?php // echo htmlspecialchars_decode($day) ?>
	</td>	
<?php endforeach ?>	

</tr>
</tbody>
</table>
</div>