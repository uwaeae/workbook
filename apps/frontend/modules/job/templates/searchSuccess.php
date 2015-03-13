<?php  use_helper('Date');?>
Die Suche lieferte <?php if($results == 100): ?>mehr als <?php endif ?> <?php echo $results ?> Erbebnisse
<table class="job">
	<thead>
	<tr>
		<th>Auftrag</th>
		<th>Status</th>
		<th>Kunde</th>
		<th>Adresse</th>
		<th>Beschreibung</th>
		<th>Rechnungsnummer</th>
		
		<th >Erledigt am</th>
	</tr>
  </thead>
  <tbody>
    <?php foreach ($jobs as $job): ?>
    	<tr class="table_item" 
			onclick="document.location = '<?php echo url_for('job/show?id='.$job->getId()) ?>'">
			<td><?php echo $job->getId() ?></td>
			<td><?php echo $job->getJobState() ?></td>
			<td><?php echo $job->getStore()->getCustomer()->getCompany() ?></td>
			
			<td><?php echo $job->getStore()->getStreet() ?><br>
			<?php echo sprintf("%1$05d", $job->getStore()->getPostcode())  ?> <?php echo $job->getStore()->getCity() ?></td>
			<td><?php echo $job->getDescription() ?></td>
			 <td>	
					<?php foreach ($job->getInvoices() as $invoice): ?>
						<?php echo $invoice->getNumber() ?>
					<?php endforeach ?>
			</td>
			<td><?php echo format_date($job->getEnd(),'dd.MM.yyyy HH:mm') ?></td>
			
		</tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php if($page > 1): ?>
	<a class="button" href="<?php echo url_for('job/search').'?page='.($page-1).'&'.$parameters ?>">
		<<<
	</a>
<?php endif ?>

<?php if($results == 100): ?>

	<a class="button" href="<?php echo url_for('job/search').'?page='.($page+1).'&'.$parameters ?>">
		>>>
	</a>

<?php endif ?>


