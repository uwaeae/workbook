
<?php foreach ($users as $user): ?>
<div class="cal_user_day" style=" width:<?php echo round(100 / count($users)) ?>%;" >	
<table border="0" class="cal_table_micro  " >
<?php $full = 0; ?>
<?php $even = true ?>
<tr>
	<th><?php echo $user->getUsername() ?>	</th>
</tr>	 
<?php foreach ($day[$user->getUsername()] as $tasks): ?>
<tr class="cal_timerow_<?php if($even) {
							echo 'odd';
							$even = false;
							} 
						else {
							echo 'even';
							$even = true;} ?>" > 
	<?php if (count($tasks) > 0): ?>
	<?php foreach ($tasks as $task): ?>
		
	<?php if ($full < $task['duration']) $full = $task['duration'] ?>
			
	<td rowspan="<?php echo $task['duration'] ?>"
		class="cal_entry cal_type_<?php echo $task['task']->getTaskTypeId() ?>
					<?php echo (!$task['task']->getScheduled()? '_finshed':' ')?>" 
					 >
	<div class="cal_entry_content" style="height: <?php echo $task['duration']*5 ?>px;" onclick="document.location='<?php echo url_for('job/show?id='.$task['task']->getJob()->getId()) ?>'">
			 	<?php echo $task['task']->getJob()->getId() ?>
	</div>
	</td>
	<?php endforeach ?>
<?php else: ?>
<?php if ($full > 1): ?>
 <td colspan="1"></td> 	
<?php endif ?>	
 <td colspan="3"></td> 
<?php $full-- ?>
<?php endif ?>

</tr> 

<?php endforeach ?>
</table>
</div>
<?php endforeach ?>