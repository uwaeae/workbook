<h1>Kunden </h1>

<a class="button" href="<?php echo url_for('customer/new') ?>">Neuer Kunde</a>
<table class="job">
  <thead>
    <tr>
      <th>Kundennummer</th>
      <th>Frimenname</th>
      <th>Straße</th>
      <th>PLZ</th>
	  <th>Ort</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($customers as $customer): ?>
    <tr class="table_item"	onclick="document.location = '<?php echo url_for('customer/show?id='.$customer->getId()) ?>'">

	 <td><?php echo $customer->getNumber() ?></td>
      <td><?php echo $customer->getCompany() ?> </td>
      <td><?php echo $customer->getStore()->getStreet() ?></td>
	  <td><?php echo $customer->getStore()->getPostcode() ?></td>
	<td><?php echo $customer->getStore()->getCity().
				 ' '.$customer->getStore()->getDestrict(); ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

