

<table>
  <thead>
    <tr>
      <th>Rechnungsnummer</th>
      <th>Erstellt am</th>
	  <th>Aufträge</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach ($invoices as $invoice): ?>
    <tr class="table_item" onclick="document.location='<?php echo url_for('invoice/edit?id='.$invoice->getId()) ?>'">

		<td><?php echo $invoice->getNumber() ?></td>
		<td><?php echo $invoice->getCreatedAt() ?></td>
		<td>
			<ul class="table_list">
			<?php foreach ($invoice->getJobs() as $job): ?>
				<li ><?php echo $job ?></li>
			<?php endforeach ?>
			</ul>
		</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  
