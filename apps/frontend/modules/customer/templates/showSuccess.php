
<img src=<?php echo '"'.$customer->getUrl().'"' ?>  alt=""/>
<h1 id=""><?php echo $customer->getNumber() ?> - <?php echo $customer->getCompany() ?></h1>
<table class="job_show"border="0" cellspacing="5" cellpadding="5">
	
	<tr>
		<td> <?php echo  $customer->getStore() ? $customer->getStore()->getStreet():'' ?></td>
		<td> <?php  echo sprintf("%1$05d", $customer->getStore()->getPostcode()); ?></td>
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
		<td colspan="1" ><a class="button" href="<?php echo url_for('customer/index') ?>">Zurück</a></td>
		<td colspan="1" ><a class="button" href="<?php echo url_for('customer/edit?id='.$customer->getId()) ?>">Basisdaten</a></td>
		<td colspan="1" ><a class="button" href="<?php echo url_for('store/edit?id='.$customer->getHeadoffice()) ?>">Adresse</a>
		<td>	
			<form action="<?php echo url_for('job/new') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
				<?php echo $form['type']->renderLabel() ?>
				<?php echo $form['type']->renderError() ?>
				<?php echo $form['type']->render() ?>
				<?php echo $form->renderHiddenFields() ?>
				<input class="button" type="submit" value="Neuen Auftrag anlegen">
			</form>
		</td>
	</tr>
  </tbody>
</table>

<table class="job_component" border="0" cellspacing="5" cellpadding="5">
	<thead>
		<tr>
			<td><a class="button" href="<?php echo url_for('store/new?customer='.$customer->getId()) ?>">Neue Filiale</a></th>
		</tr>
	<tr>
		<th>Filialnummer</th>
		<th>Strasse</th>
		<th>PLZ</th>
		<th>Stadt</th>
		<th>Telefon</th>
		<th>Fax</th>
		<th>Kontakt</th>
		<th>Info</th>
	</tr>
	<thead>
	<?php foreach ($customer->getStores() as $store ): ?>
	<?php if ($store->getId() != $customer->getHeadoffice()): ?>
		

	<tr class="table_item" onclick="document.location = '<?php echo url_for('store/edit?id='.$store->getId()) ?>'">
		<td><?php echo $store->getNumber() ?></td>
		<td><?php echo $store->getStreet() ?></td>
		<td><?php echo $store->getPostcode() ?></td>
		<td><?php echo $store->getCity() ?> <?php echo $store->getDestrict() ?></td>
		<td><?php echo $store->getFon() ?></td>
		<td><?php echo $store->getFax() ?></td>
		<td><?php echo $store->getContact() ?></td>
		<td><?php echo substr($store->getInfo(),0,40) ?></td>
	</tr>	
		<?php endif ?>
	<?php endforeach ?>
</table>
<?php //include_partial('pageing', array('pager' => $stores,'url' => ' ')) ?>

