<?php  use_helper('Date');?>
Die Suche lieferte <?php echo $results ?> Erbebnisse
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
			<?php echo $job->getStore()->getPostcode() ?> <?php echo $job->getStore()->getCity() ?></td>
			<td><?php echo substr($job->getDescription(), 0, 50).'...' ?></td>
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



