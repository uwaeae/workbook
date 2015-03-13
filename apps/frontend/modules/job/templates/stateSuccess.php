
<?php  use_helper('Date');?>




<?php foreach ($jobstate as $state ): ?>


<table class="job">
  <thead>
	 <tr>
		<td colspan = "7 ">
	<h3 id=""><?php echo $state['Name'] ?></h3>	
		</td>	
		</tr>	
    <tr>
		<th>Kunde</th>
		<th>Filiale</th>
		<th>Adresse</th>
		<th>Auftrag</th>
		<th>Typ</th>
		<th>bis zum</th>
		<th>Thermin</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($state['jobs'] as $job): ?>
	<tr class="table_item" "
		onclick="document.location = '<?php echo url_for('job/show?id='.$job->getId()) ?>'">
		<td><?php echo $job->getStore()->getCustomer()->getCompany() ?></td>
		<td><?php echo $job->getStore()->getNumber() ?></td>
		<td><?php echo $job->getStore()->getStreet() ?><br>
		<?php echo sprintf("%1$05d", $job->getStore()->getPostcode())  ?> <?php echo $job->getStore()->getCity() ?></td>
		<td><?php echo substr($job->getDescription(), 0, 50).'...' ?></td>
		<td><?php echo $job->getJobType() ?></td>
		<td <?php echo ($job->getEnd() < date('c')? 'class="fault"' : ' ' ) ?>>
		<?php echo format_date($job->getEnd(),'dd.MM.yyyy HH:mm') ?></td>
		
		<?php if (1): ?>
		<td ><?php foreach ($job->getCalendar() as $thermin ): ?> 
		<ul class="table_list">	
			<span <?php if ($job->getEnd()< $thermin->getBeginn()): ?>
				class="fault"
			<?php endif ?> >
		<?php echo format_date($thermin->getBeginn(),'dd.MM.yyyy HH:mm')  ?>
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


