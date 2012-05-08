<?php  use_helper('Date');?>
<?php use_javascript('calendar.js') ?>
<?php include_partial('openjob', array('jobs' => $jobs)) ?>
<?php include_partial('filterform', array('form' => $form , 'type' => 'table')) ?>




<div id="calendar">
<table class="calendar">
	
	<colgroup>
		<col class="cal_col_timeline"style="width:4%;" />
		<col class="cal_col_even" style="width:13%;" />
		<col class="cal_col_odd" style="width:13%;"/>
		<col class="cal_col_even" style="width:13%;"/>
		<col class="cal_col_odd" style="width:13%;"/>
		<col class="cal_col_even" style="width:13%;"/>
		<col class="cal_col_odd" style="width:13%;"/>
		<col class="cal_col_even"style="width:13%;" />
		<col class="cal_col_odd" style="width:13%;"/>
	</colgroup>
<thead>
	<tr>
			<td colspan="7" style="background-color: white;">
						<?php include_partial('calnav', array('type' => 'table','next' => $next)) ?>
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
	<?php include_partial('timeline', array('time' => $timeline,'type' => 'medium')) ?>
</td>

<?php foreach ($calendar as $day): ?>
	<td class="cal_week_col"	>
		
			<?php include_partial('task_medium', array('day' => $day['task'],'user' => $user,'style'=> 'width:'.round(30 * count($UserArray)))) ?>
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

