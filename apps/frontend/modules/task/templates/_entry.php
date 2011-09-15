<h3 class="job_items_head">Material 

	</h3>
<table class="job_component">
  <thead>
	  <tr>
			<td colspan="2">
						<a class="button" href="<?php echo url_for('entry/new/?taskid='.$task->getId()) ?>">
						bearbeiten</a>
				</td>
		</tr>
    <tr>
      <th colspan="2" style="width:10%;">Einheit</th>
      <th style="width:auto;">Artikel</th>
      <th style="width:auto;">Beschreibung</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($task->getEntry() as $entry): ?>
    <tr>
		<td><?php echo $entry->getAmount() ?> </td>
		<td><?php echo $entry->getItem()->getUnit()  ?></td>		
		<td><?php echo $entry->getItem()->getCode() ?></td>
		<td>
		<?php 
		 echo $entry->getItem()->getDescription();
		 echo $entry->getDescription(); ?></td>
		
    </tr>
    <?php endforeach; ?>
  </tbody>
	<tfoot>	
    <tr>
		<td ></td>
		<td ></td>
		<td ></td>
		
      <td >
		
      </td>
    </tr>
  </tfoot>
</table>
