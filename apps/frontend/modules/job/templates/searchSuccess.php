<?php  use_helper('Date');?>

<table>
  <thead>
    <tr>
      <th>Kunde</th>
      <th>Auftrag</th>
      <th>Rechnungsnummer</th>
      <th>Erledigt am</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($jobs as $job): ?>
    <tr 	class="table_item" "
			onclick="document.location = '<?php echo url_for('job/show?id='.$job->getId()) ?>'">
      <td><?php echo $job->getStore()->getCustomer()->getCompany() ?><br>
      <?php echo $job->getStore()->getStreet() ?><br>
      <?php echo $job->getStore()->getPostcode()  ?>
      <?php echo $job->getStore()->getCity()  ?></td>
      <td><?php echo substr($job->getDescription(),0,50) ?></td>
      <td>	
			<?php foreach ($job->getInvoices() as $invoice): ?>
				<?php echo $invoice->getNumber() ?>
			<?php endforeach ?>
	  </td>
      <td>
			<?php foreach ($job->getTasks()  as $task): ?>
				<?php echo format_date($task->getStart() ,'dd.MM.yyyy') ?>
			<?php endforeach ?>
		</td>

	  
    </tr>

    <?php endforeach; ?>
  </tbody>
</table>



