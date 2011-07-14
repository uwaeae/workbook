<?php  use_helper('Date');?>
<?php use_javascript('jobs.js') ?>
<?php foreach ($jobstate as $state ): ?>

<table class="job">
  <thead>
	 <tr>
		<th class="job_type_<?php echo $state['type'] ?>_head job_type_head" colspan = "7">
	<?php echo $state['Name'] ?>	(<?php echo count($state['jobs']) ?>)
		</th>	
		</tr>	
    <tr class="job_type_<?php echo $state['type']?>_body">
		<th>Kunde</th>
		<th>Filiale</th>
		<th>Adresse</th>
		<th>Auftrag</th>
		<th>Typ</th>
		<th>bis zum</th>
	<?php if ($state['type']> 1): ?>
		<th>Thermin</th>
	<?php endif ?>	
	</tr>
	</thead>
	<tbody class="job_type_<?php echo $state['type']?>_body">
	<?php foreach ($state['jobs'] as $job): ?>
	<tr class="table_item" 
		onclick="document.location = '<?php echo url_for('job/show?id='.$job->getId()) ?>'">
		<td><?php echo $job->getStore()->getCustomer()->getCompany() ?></td>
		<td><?php echo $job->getStore()->getNumber() ?></td>
		<td><?php echo $job->getStore()->getStreet() ?><br>
		<?php echo $job->getStore()->getPostcode() ?> <?php echo $job->getStore()->getCity() ?></td>
		<td><?php echo substr($job->getDescription(), 0, 50).'...' ?></td>
		<td><?php echo $job->getJobType() ?></td>
		<td <?php if($job->getEnd() < date('c') AND $state['type'] < 4)  echo 'class="fault"'; ?>>
		<?php echo format_date($job->getEnd(),'dd.MM.yyyy HH:mm') ?></td>
		
		<?php if ($state['type']> 1): ?>
		<td ><?php foreach ($job->getTasks() as $thermin ): ?> 
		<ul class="table_list">	
			<span <?php if ($job->getEnd()< $thermin->getScheduled() AND $state['type'] < 4): ?>
				class="fault"
			<?php endif ?> >
		<?php echo format_date($thermin->getStart(),'dd.MM.yyyy HH:mm')  ?>
		</span>
			
		<?php 
			foreach ($thermin->getUsers() as $user) {
				echo '<li >'.$user->getUsername().'</li>';
			}
		 ?>
		</ul>	<?php endforeach ?></td>
		<?php endif ?>
    </tr>
	
    <?php endforeach; ?>
  </tbody>
</table>

<?php endforeach ?>