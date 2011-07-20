

<?php foreach ($users as $user): ?>
<div class="cal_user_day" style=" width:<?php echo round(100 / count($users))-1?>%;" >	
<table border="0" class="cal_table_user  " >
<?php $full = 0; ?>
<?php $even = true ?>
<tr class="cal_table_head">
	<th colspan="2"><?php echo $user->getUsername() ?>	</th>
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
		class="cal_entry cal_type_<?php echo $task['task']->getTaskTypeId() ?>"  <?php echo ((!$task['task']->getScheduled() AND $task['task']->getTaskTypeId() < 2)? 'style="opacity: 0.2;"':' ')?> >
					
	<div class="cal_entry_content" style="height: <?php echo $task['duration']*40 - 18 ?>px;" onclick="document.location='<?php echo url_for(
	($task['task']->getTaskTypeId() < 2? 
	'job/show?id='.$task['task']->getJob()->getId() : 
	'task/edit?type='.$task['task']->getTaskTypeId().'&id='.$task['task']->getId() ) )  ?>'">
			 	<?php echo $task['task']->getJob()->getId() ?>
			
				
	</div>
	
		<a href="<?php echo url_for('task/edit?type=0&id='.$task['task']->getId()) ?>" style="float:right;position: relative;" >
				<img src="/images/icons/calendar_edit.png" ></a>
	
	
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
<!--
<div class="cal_day" style=" width:<?php echo round(30 * count($users))+ 5 ?>px;" >
</div>

-->