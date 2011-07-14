<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<table>
 		<tr>
			<th>Matchcode</th>
			<th>Artikel</th>
			<th>Anzahl</th>
			<th>Einheit</th>
		</tr>
		<?php foreach ($entrys as $entry): ?>
		<tr>
			
			<td><?php echo $entry->getItem()->getCode() ?></td>
			<td><?php echo $entry->getItem()->getDescription() ?>
			<?php echo $entry->getDescription() ?></td>
			<td><?php echo $entry->getAmount() ?></td>
			<td><?php echo $entry->getItem()->getUnit() ?></td>
			<td> 
			<a href="<?php echo url_for('entry/delete?id='.$entry->getId(),array('method' => 'delete')) ?>	">
					<img src="/images/icons/cross.png" /></a></td>
	    </tr>
	    <?php endforeach ?>
  
<?php  include_partial('form', array('form' => $form, 'job' => $job)) ?>
</table>