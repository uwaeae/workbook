<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<table class="entry">
	<thead>
 		<tr>
			<th>Matchcode</th>
			<th>Artikel</th>
			<th>Anzahl</th>
			<th>Einheit</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($entrys as $entry): ?>
		<tr>
			
			<td><?php echo $entry->getCode() ?></td>
			<td><?php echo $entry->getDescription() ?></td>
			<td><?php echo $entry->getAmount() ?></td>
			<td><?php echo $entry->getUnit() ?></td>
			<td> 
			<a href="<?php echo url_for('entry/delete?id='.$entry->getId(),array('method' => 'delete')) ?>	">
					<img src="/images/icons/delete.png" /></a></td>
	    </tr>
	    <?php endforeach ?>
  </tbody>
<tfoot>
<?php  include_partial('form', array('form' => $form, 'task' => $task)) ?>
<tr>
		<td> 
		<a class="button" href="<?php echo url_for('task/edit?id='.$task->getId()) ?>	">
			zurück</a></td>
<tr>	
</tfoot>
</table>