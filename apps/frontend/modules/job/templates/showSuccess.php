<?php  use_helper('Date');?>
<?php use_javascript('jobshow.js') ?>
<?php include_partial('openjob', array('jobs' => $openjobs)) ?>

<table class="job_show">
  <tbody>
    <tr>
      <th>Auftragsnummer </th>
      <td><?php echo $job->getId() ?></td>
	<th>Status: </th>
      <td><?php echo $job->getJobState() ?></td>
	<th>Art:</th>
      <td><?php echo $job->getJobType() ?></td>
    </tr>
        <tr>
      <th>Ende</th>
      <td><?php echo format_date($job->getEnd(),'dd.MM.yyyy HH:mm') ?></td>
 
      <th>Beginn</th>
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
	<th>Adresse</th>
      <td ><?php echo $job->getStore()->getStreet() ?> <br>
	<?php echo $job->getStore()->getPostcode() ?> <?php echo $job->getStore()->getCity() ?>
	
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

	</tbody>
	<tfood>
	<tr>
		<td  colspan="5">
		<ul>
			<li class="table_menu_left">	
			<a class="button" href="<?php echo   url_for($back) ?>">	
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


<h3 class="job_work" >Arbeiten und Thermine </h3>
<table class="job_component">
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
	<th style="width:100px;"> </th>
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
<?php endif ?> >
		<td><?php echo ($task->getScheduled()? 'Thermin': 'Ausgeführt ') ?></td>
		<td><?php echo format_date($task->getStart(),'dd.MM.yyyy HH:mm') ?></td>
		<td><?php echo format_date($task->getEnd() ,'dd.MM.yyyy HH:mm') ?></td>
		<td><?php echo $task->getInfo() ?></td>
		<td><?php echo format_date($task->getCreatedAt(),'dd.MM.yyyy') ?></td>
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
<h3 class="job_items_head">Material 
	<?php if ($job->getJobStateId() < 2): ?>
			<a href="<?php echo url_for('entry/new/?job='.$job->getId()) ?>">
			<img src="/images/icons/add.png" /></a>
	<?php endif ?>
	</h3>
<table class="job_component job_items_body ">
  <thead>
    <tr>
      <th colspan="2" style="width:100px;">Einheit</th>
      <th style="width:100px;">Artikel</th>
      <th style="width:300px;">Beschreibung</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($job->getEntry() as $entry): ?>
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


