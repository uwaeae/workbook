<div>
<table border="0" class="cal_table">
<?php $this->full = 0; ?>

<?php $even = true ?> 
<?php foreach ($day as $tasks): ?>
<tr class="cal_timerow_<?php if($even) {
							echo 'even';
							$even = false;
							} 
						else {
							echo 'odd';
							$even = true;} ?>" > 
<?php if (count($tasks) > 0): ?>
	<?php foreach ($tasks as $task): ?>
		

	<td rowspan="<?php echo $task['duration'] ?>"
		class="cal_type_<?php echo $task['task']->getTaskTypeId() ?>
					<?php echo (!$task['task']->getScheduled()? '_finshed':' ')?>" >

	<br>
	<a href= ><img src="/images/icons/calendar_edit.png" ></a>
	<a href= ><img src="/images/icons/calendar_edit.png" ></a>
	</td>
	<?php endforeach ?>
<?php else: ?>
<td colspan="3"></td> 

<?php endif ?>

</tr> 

<?php endforeach ?>
</table>
</div>