<?php  use_helper('Date');?>
<table>
  <tbody>
    <tr>
      <th>Auftragsnummer </th>
      <td><h1><?php echo $job->getId() ?></h1></td>
	<th>Status: </th>
      <td><?php echo $job->getJobState() ?></td>
	<th>Art:</th>
      <td><?php echo $job->getJobType() ?></td>
    </tr>
        <tr>
      <th>Ende :</th>
      <td><?php echo format_date($job->getEnd(),'dd.MM.yyyy HH:mm') ?></td>
 
      <th>Beginn :</th>
      <td><?php echo format_date($job->getStart(),'dd.MM.yyyy HH:mm') ?></td>
    </tr>
  	<?php if ($job->getInvoices()->count() > 0): ?>
		<tr>
			<th>Rechnungsnummer</th>
			<td>
				<?php foreach ($job->getInvoices() as $invoice): ?>
					<?php echo link_to($invoice->getNumber(),'invoice/edit?id='.$invoice->getId()) ?>
				<br>
				<?php endforeach ?>
			</td>
		</tr>
		<?php endif ?>
	<tr>
      <th colspan="2">Ansprechpartner vor Ort :</th>
      <td colspan="4"><?php echo $job->getContactPerson() ?></td>
	</tr>

	<tr>
      <th colspan="2">Kontakt Informationen:</th>
      <td colspan="4"><?php echo $job->getContactInfo() ?></td>
    </tr>
    
    <tr>
      <th>Kunde</th>
      <td colspan="3" ><?php echo $job->getStore()->getCustomer()->getCompany() ?></td>
  </tr>
    <tr>
	<th>Straße</th>
      <td ><?php echo $job->getStore()->getStreet() ?></td>
	<th>PLZ</th>
      <td ><?php echo $job->getStore()->getPostcode() ?></td>
	<th>Ort</th>
      <td ><?php echo $job->getStore()->getCity() ?></td>
    </tr>
	
  <tr>
     	 <th>Auftrag:</th>
	      <td colspan="5"><?php echo $job->getDescription() ?></td>
    </tr>

    <tr>
      <th>Erstellt am</th>
      <td colspan="3"><?php echo format_date($job->getCreatedAt(),'dd.MM.yyyy HH:mm') ?></td>
  
      <th>Zuletzt Bearbeitet am</th>
      <td><?php echo format_date($job->getUpdatedAt(),'dd.MM.yyyy HH:mm') ?></td>
    </tr>
   <!-- <tr>
		<th rowspan="<?php echo $job->getTasks()->count()+1 ?>">Geplant</th>
		
		<?php foreach ($job->getTasks() as $thermin ): ?>
		<?php if ($thermin->getScheduled()): ?>
			
		
		<td colspan="3" class="list_button"	onclick="document.location='<?php echo url_for('calendar/edit?id='.$thermin->getId()) ?>'">
		<?php echo format_date($thermin->getStart(),'dd.MM.yyyy HH:mm')  ?>
		<ul class="table_list">	
		<?php 
			foreach ($thermin->getUsers() as $user) {
				echo '<li >'.$user->getUsername().'</li>';
			}
		 ?>
		</ul>
		<?php endif ?>	
	
	
		</td></tr>
		

	
		<?php endforeach ?>
		-->

  </tbody>
<tfood>
	<tr>
		<td  colspan="5">
		<ul>
			<li class="table_menu_left">	
			<a class="button" href="<?php echo   url_for('job/state') ?>">	
				zurück</a></li>
				<?php if ($sf_user->hasPermission('Bearbeiten')): ?>
					
			<li class="table_menu_left">
		<a class="button" href="<?php echo url_for('job/edit?id='.$job->getId()) ?>">
				ändern</a></li>
				<?php endif ?>
		</ul>	
		</td>
		<td>
		<?php if (!$job->hasSheduledTasks()): ?>
			
    		
		<?php if ($job->getJobStateId() > 1): ?>
				<a class="button" href="<?php echo url_for('invoice/new/?job='.$job->getId()) ?>">
				Rechnungsnummer erstellen</a>
				<a href="<?php echo url_for( 'job/finish/?id='.$job->getId()) ?>" 
					onclick="return confirm('Sind sie sicher das sie den Auftrag Nummer 1 abschliesen möchten?');" 
					class="button" >
					Aufschliesen 
				</a>
		<?php else: ?>
			<a href="<?php echo url_for( 'job/finish/?id='.$job->getId()) ?>" 
				onclick="return confirm('Sind sie sicher das sie den Auftrag Nummer 1 wieder aufschliesen möchten?');" 
				class="button" >
				<img src="/images/icons/tick.png"  />Auftrag Abschliesen
			</a>
		<?php endif ?>
	<?php endif ?>
	</tr>
</tfood>	
</table>

<hr />


<h3>Arbeiten und Thermine 
	

	   </tr>
	</h3>
<table>
  <thead>
    <tr>
		<td colspan="2">
			<?php if ($job->getJobStateId() < 2): ?>
			 <a class="button" href="<?php echo url_for('task/new/?job='.$job->getId()) ?>">
			 neue Arbeit </a>
				<?php endif ?>
		
		<?php if ($sf_user->hasPermission('Zuweisen')) :?>
				
				<a class="button" href="<?php echo url_for('task/new/?job='.$job->getId().'&type=0') ?>">	
					neuer Thermin</a>
			
				<?php endif ?>
			</td>
	</tr>
	<th style="width:50px;"> </th>
	<th style="width:150px;">Start</th>
	<th style="width:150px;">Ende</th>
	<th style="width:350px;">Arbeiten</th>
	<th style="width:150px;">Erstellt</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($job->getTasks() as $task): ?>
    <tr 
<?php if ($job->getJobStateId() < 2): ?> 
	class="table_item"
	onclick="document.location='<?php echo url_for('task/edit?id='.$task->getId()) ?>'"
<?php endif ?> 
>
	<td><?php echo ($task->getScheduled()? 'Geplan': 'Erledigt') ?></td>
      <td><?php echo $task->getStart() ?></td>
      <td><?php echo $task->getEnd() ?></td>
      <td><?php echo $task->getInfo() ?></td>
      <td><?php echo $task->getCreatedAt() ?></td>
    	</tr>
    <?php endforeach; ?>
  </tbody>
	<tfoot>	
    <tr>
	 <td ></td>
	<td ></td>
	<td ></td>
	<td ></td>
      <td >
				</a>
      </td>
    </tr>
  </tfoot>
</table>
<h3>Material 
	<?php if ($job->getJobStateId() < 2): ?>
			<a href="<?php echo url_for('entry/new/?job='.$job->getId()) ?>">
			<img src="/images/icons/add.png" /></a>
	<?php endif ?>
	
		
		</h3>
<table>
  <thead>
    <tr>
      <th style="width:50px;">Einheit</th>
      <th style="width:100px;">Artikel</th>
      <th style="width:300px;">Beschreibung</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($job->getEntry() as $entry): ?>
    <tr>
		<td><?php echo $entry->getAmount() ?></td>
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

