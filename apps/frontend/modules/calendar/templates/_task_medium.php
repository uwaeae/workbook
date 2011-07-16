<div>
<table border="0" class="cal_table_medium">
<?php $full = 0; ?>

<?php $even = true ?> 
<?php foreach ($day as $tasks): ?>
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
					onclick="document.location='<?php echo url_for('job/show?id='.$task['task']->getJob()->getId()) ?>'" >
						<a href="<?php echo url_for('task/edit?type=0&id='.$task['task']->getId()) ?>" style="float:right;">
							<img src="/images/icons/calendar_edit.png" ></a>		
		<div class="cal_entry_content" style="height: <?php echo $task['duration']*30 ?>px;">
	<p><strong><?php echo $task['task']->getJob()->getStore()->getCustomer()->getCompany() ?></strong></p>
	<p><?php echo $task['task']->getJob()->getStore()->getStreet() ?>	<br>
	<?php echo	$task['task']->getJob()->getStore()->getPostcode() ?> <?php echo $task['task']->getJob()->getStore()->getCity() ?></p>
	<p><?php echo substr(	$task['task']->getJob()->getDescription(), 0, 100) ?></p>
	</div>
	
	</td>
	<?php endforeach ?>
<?php else: ?>
<?php if ($full > 0): ?>
 <td colspan="1"></td> 	
<?php endif ?>	
 <td colspan="3"></td> 
<?php $full-- ?>
<?php endif ?>

</tr> 

<?php endforeach ?>
</table>
</div>