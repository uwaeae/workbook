
<img src=<?php echo '"'.$customer->getUrl().'"' ?>  alt=""/>
<h1 id=""><?php echo $customer->getNumber() ?> - <?php echo $customer->getCompany() ?></h1>
<table border="0" cellspacing="5" cellpadding="5">
	
	<tr>
		<td> <?php echo $customer->getStore()->getStreet() ?></td>
		<td> <?php echo $customer->getStore()->getPostcode() ?></td>
		<td><?php echo $customer->getStore()->getCity().' '.$customer->getStore()->getDestrict(); ?></td>
	</tr>
	<tr>
 		<td>Telefonnummer: </td><td><?php echo $customer->getStore()->getFon() ?></td>
		<td>Fax</td><td><?php echo $customer->getStore()->getFax() ?></td>
		
	

	</tr>
	<tr>
		<td>Ansprechpartner</td><td><?php echo $customer->getStore()->getContact() ?></td>
		<td>Informatioen</td><td><?php echo $customer->getStore()->getInfo() ?></td>
	</tr>
	<tr>
			<td><a href="<?php echo $customer->getUrl() ?>">Homepage</a></td>
	</tr>
	<tr>
			<td><a class="button" href="<?php echo url_for('customer/edit?id='.$customer->getId()) ?>">Bearbeiten</a></td>
			<td><a class="button" href="<?php echo url_for('customer/index') ?>">Zurück</a></td>
	</tr>
  </tbody>
</table>

<table border="0" cellspacing="5" cellpadding="5">
	<tr>
		<th>Filialnummer</th>
		<th>Strasse</th>
		<th>PLZ</th>
		<th>Stadt</th>
		<th>Land</th>
		<th>Ansprechpartner</th>
		<th>Info</th>
		<th>Telefon</th>
		<th>Fax</th>
	</tr>
	<?php foreach ($customer->getStores() as $store ): ?>
	<tr>
		<td><?php echo $store->getNumber() ?></td>
		<td><?php echo $store->getStreet() ?></td>
		<td><?php echo $store->getPostcode() ?></td>
		<td><?php echo $store->getCity() ?> <?php echo $store->getDestrict() ?></td>
		<td><?php echo $store->getCountry() ?></td>
		<td><?php echo $store->getContact() ?></td>
		<td><?php echo $store->getInfo() ?></td>
		<td><?php echo $store->getFon() ?></td>
		<td><?php echo $store->getFax() ?></td>
	</tr>	
	
	<?php endforeach ?>
</table>


