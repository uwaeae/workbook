
<?php foreach ($users as $user): ?>
<div class="cal_user_day" style=" width:<?php echo round(100 / count($users))-1 ?>%;" >	
<table border="0" class="cal_table_large">
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
		class="cal_entry cal_type_<?php echo $task['task']->getTaskTypeId() ?>
					<?php echo (!$task['task']->getScheduled()? '_finshed':' ')?>" 
					 >
				<!--onclick="document.location='<?php //echo url_for('job/show?id='.$task['task']->getJob()->getId()) ?>'"-->	
	<a href="<?php echo url_for('task/edit?type=0&id='.$task['task']->getId()) ?>" style="float:right;" >
			<img src="/images/icons/calendar_edit.png" ></a>				
	<div class="cal_entry_content" style="height: <?php echo $task['duration']*50 - 2  ?>px;">
			<?php if($task['task']->getJob()->getJobTypeId() == 1): ?>
			<span class="fault">FIX</span>		
			<?php endif ?>
			<?php if ($task['task']->getTaskTypeId() == 1): ?>
				
		
		 	<strong><?php echo $task['task']->getJob()->getStore()->getCustomer()->getCompany()?></strong>
				<p> <strong>Adresse</strong>
				<?php echo $task['task']->getJob()->getStore()->getStreet() ?>	<br>
				<?php echo sprintf("%1$05d", $task['task']->getJob()->getStore()->getPostcode()) ?>
				<?php echo $task['task']->getJob()->getStore()->getCity() ?><br></p>
			
			<p><strong>Info</strong>
			<?php echo 	$task['task']->getJob()->getDescription() ?></p>
				<?php else: ?>
						<strong><?php echo $task['task']->getTaskType() ?></strong>
				<?php endif ?>
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




