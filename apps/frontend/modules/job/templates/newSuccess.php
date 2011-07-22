<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>
<table border="0" cellspacing="5" cellpadding="5" class="job_show">
	
	<tr>
		<th>Kunde</th>
		<td><?php echo $customer->getCompany() ?></td>
		<th>Kundennummer</th><td><?php echo $customer->getNumber() ?></td>
		<th>Auftragstyp</th><td><?php echo $type ?></td>
	</tr>
</table>
<?php include_partial('form', array('form' => $form)) ?>
