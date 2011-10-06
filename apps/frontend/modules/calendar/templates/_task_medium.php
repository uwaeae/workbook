



<table border="0" class="cal_table_medium  " >
<?php $full = 0; ?>
<?php $even = true ?>

	<tr class="cal_table_head">
		<th colspan="2" ><?php echo $user->getUsername() ?>	</th>
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
			class="cal_entry cal_type_<?php echo $task['task']->getTaskTypeId() ?><?php echo ((!$task['task']->getScheduled() AND $task['task']->getTaskTypeId() < 2)? '_finshed':' ')?>" >


		<div class="cal_entry_content_over"  >
							 	<a href="<?php echo url_for('task/edit?type=0&id='.$task['task']->getId()) ?>" style="float: right;" >
											<img src="/images/icons/calendar_edit.png" ></a>						
								<span onclick="document.location='<?php echo url_for(
												($task['task']->getTaskTypeId() < 2? 
												'job/show?id='.$task['task']->getJob()->getId() : 
												'task/edit?type='.$task['task']->getTaskTypeId().'&id='.$task['task']->getId() ) )  ?>'">
								<?php if($task['task']->getJob()->getJobTypeId() == 1): ?>
									<span class="fault">FIX</span>		
								<?php endif ?>
								<p>	<?php echo format_date($task['task']->getStart(),'dd.MM.yyyy HH:mm')   ?>	</p>	
									<p>	<?php echo $task['task']->getJob()->getStore()->getCustomer()->getCompany() ?><br>
								<?php echo $task['task']->getJob()->getStore()->getStreet() ?><br>
								<?php echo $task['task']->getJob()->getStore()->getPostcode() ?>	
								<?php echo $task['task']->getJob()->getStore()->getCity() ?>
								<?php echo $task['task']->getJob()->getStore()->getDestrict() ?></p>
								<p><?php echo $task['task']->getJob()->getDescription() ?></p></span>

		</div>							
		<div class="cal_entry_content" style="height: <?php echo $task['duration']*30 -1 ?>px;">
				 	<?php //echo $task['task']->getJob()->getID() ?>
				 		
				 	<?php if($task['task']->getJob()->getJobTypeId() == 1): ?>
						<span class="fault">FIX</span>		
					<?php endif ?>
						<?php if ($task['task']->getTaskTypeId() == 1): ?>
								<?php echo substr($task['task']->getJob()->getStore()->getCustomer()->getCompany(),0,15) ?><br>
								<?php echo substr($task['task']->getJob()->getStore(),0,15) ?><br>
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


