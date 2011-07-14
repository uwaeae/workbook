<h1>Customers List</h1>

<?php //echo var_dump($customers[0]->getHeadoffice() ); ?>
<table>
  <thead>
    <tr>
      <th>Kundennummer</th>
      <th>Frimenname</th>
      <th>Logo</th>
      <th>Url</th>
      <th>Straße</th>
      <th>PLZ</th>
	  <th>Ort</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($customers as $customer): ?>
    <tr>
	 <td><?php echo $customer->getNumber() ?></td>
      <td><a href="<?php echo url_for('customer/show?id='.$customer->getId()) ?>"><?php echo $customer->getCompany() ?> </a></td>
      <td><?php echo $customer->getLogo() ?></td>
      <td><?php echo $customer->getUrl() ?></td>
      <td><?php echo $customer->getStore()->getStreet() ?></td>
	  <td><?php echo $customer->getStore()->getPostcode() ?></td>
	<td><?php echo $customer->getStore()->getCity().
				 ' '.$customer->getStore()->getDestrict(); ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('customer/new') ?>">New</a>
