<?php  use_helper('Date');?>
<?php use_javascript('jobshow.js') ?>
<?php include_partial('openjob', array('jobs' => $openjobs_near,'type'=> 'open_jobs','info'=> 'Offene Aufträge  in der Nähe')) ?>
<?php include_partial('openjob', array('jobs' => $openjobs_same,'type'=> 'open_filiale','info'=> 'Offene Aufträge  in der Filiale')) ?>

<table class="job_show">
  <tbody>
    <tr>
      <th>Auftragsnummer </th>
      <td><?php echo $job->getId() ?></td>
	<th>Status: </th>
      <td><?php echo $job->getJobState() ?></td>
	<th>Typ:</th>
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
      <th colspan="2">Auftraggeber</th>
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
	     	 <th>Dateien</th>
		      <td colspan="5">
				<ul>
				<?php foreach ($job->getFiles() as $file): ?>
					<li class="jobfile"><?php echo link_to($file->getName(),'/file/get/?id='.$file->getID()) ?>
						<?php echo link_to('Delete', 'file/delete?id='.$file->getID(), array('method' => 'delete', 'confirm' => 'Are you sure?','class'=>'button','style'=> 'float:right;')) ?></li>
				<?php endforeach ?>
				<?php if ($job->getJobStateId() < 2): ?> 	
					<li class="jobfile newfilebutton"><label class="button newfilebutton">Neue Datei</label></li>
					<li class="jobfile newfileform">
	<?php include_partial('fileform', array('form' => $form,'job' => $job->getId())) ?>
						</li>
				<?php endif ?>
				</ul>
				
			</td>
	</tr>

    <tr>
	
 		<th>erstellt am</th>
		<td ><?php echo format_date($job->getCreatedAt(),'dd.MM.yyyy HH:mm') ?></td>
		<td ><?php echo $create->getUsername() ?></td>
		<th>Zuletzt bearbeitet am</th>
		<td><?php echo format_date($job->getUpdatedAt(),'dd.MM.yyyy HH:mm') ?></td>
		<td ><?php echo $update->getUsername() ?></td>
	
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
				<?php if ($job->getJobStateId() < 2): ?> 	
			<li class="table_menu_left">
						
		<a class="button" href="<?php echo url_for('job/edit?id='.$job->getId()) ?>">
				ändern</a></li>
				<?php endif ?>
				<?php endif ?>
				
		</ul>	
		</td>
		<td>
			
    		
		<?php if ($job->getJobStateId() > 1): ?>
				<a class="button" href="<?php echo url_for('invoice/new/?job='.$job->getId()) ?>">
				Rechnungsnummer erstellen</a>
				<a href="<?php echo url_for( 'job/finish/?id='.$job->getId()) ?>" 
					onclick="return confirm('Sind sie sicher das sie den Auftrag Nummer <?php echo $job->getId() ?> wieder einstellen möchten?');" 
					class="button" >
					Auftrag wieder einstellen 
				</a>
		<?php else: ?>
			<a href="<?php echo url_for( 'job/finish/?id='.$job->getId()) ?>" 
				onclick="return confirm('Sind sie sicher das sie den Auftrag Nummer <?php echo $job->getId() ?> wieder abschliesen möchten?');" 
				class="button" >
				<img src="/images/icons/tick.png"  />Auftrag abschließen
			</a>
		<?php endif ?>
	</tr>
	</tfood>	
</table>

<hr />


<h3 class="job_work" >Termin </h3>
<table class="job_component">
  <thead>
    <tr>
		<td colspan="2">
			<?php if ($job->getJobStateId() < 2): ?> 
					<a class="button" href="<?php echo url_for('task/new/?job='.$job->getId().'&type=0') ?>">	
					Termin planen</a></li>
			<?php endif ?>
		</td>
	</tr>
	<th style="width:150px;">Start</th>
	<th style="width:150px;">Ende</th>
	<th style="width:200px;">Eingeplant</th>
	<th style="width:200px;">Erstellt</th>
	<th style="width:200px;"></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($job->getTasks() as $task): ?>
<?php if ($task->getScheduled()): ?>
	
  
<tr 
<?php if ($job->getJobStateId() < 2): ?> 
	class="table_item"
<?php endif ?> >
		<td><?php echo format_date($task->getStart(),'dd.MM.yyyy HH:mm') ?></td>
		<td><?php echo format_date($task->getEnd() ,'dd.MM.yyyy HH:mm') ?></td>
		<td><?php foreach ($task->getUsers() as $user): ?>
			<?php echo $user ?><br>
		<?php endforeach ?></td>
		<td><?php echo format_date($task->getCreatedAt(),'dd.MM.yyyy HH:mm') ?>
			<?php echo $task->getCreator()->getUsername() ?>
		</td>
		<td>
		
		
			<a class="button" href="<?php echo url_for('task/edit?id='.$task->getId().'&type=0') ?>">
		Bearbeiten</a>
		<?php if ($task->hasUser($sf_user->getId())):?>
				<a class="button" href="<?php echo url_for('task/edit?id='.$task->getId().'&type=1') ?>">
				Ausgeführt</a>
		<?php endif ?> 
	
		</td>
	</tr>
	<?php endif ?>  
    <?php endforeach; ?>
  </tbody>
</table>



<h3 class="job_work" >Arbeiten </h3>
<table class="job_component">
  <thead>
    <tr>
		<td colspan="2">
			<?php if ($job->getJobStateId() < 2): ?> 
			 <a class="button" href="<?php echo url_for('task/new/?job='.$job->getId()) ?>">
			 neue Arbeit </a>
		
				
			<?php endif ?>
				
		</td>
	</tr>
	<th style="width:150px;">Start</th>
	<th style="width:150px;">Ende</th>

	<th style="width:350px;">Arbeiten</th>
	<th style="width:200px;">Mitarbeiter</th>
	<th style="width:50px;">Stunden</th>
	<th style="width:150px;">Erstellt</th>
	</tr>
	</thead>
	<tbody>
<?php foreach ($work as $task): ?>
		<tr 
		
		<?php if ($job->getJobStateId() < 2): ?> 
			class="table_item"
			onclick="document.location='<?php echo url_for('task/'.(($task['task']->hasUser($sf_user->getId()) OR $sf_user->hasGroup('admin')) ?'edit':'show').'?id='.$task['task']->getId()) ?>'"
			<?php else: ?>
			<?php if ($sf_user->hasGroup('admin')): ?>
					class="table_item"
						onclick="document.location='<?php echo url_for('task/edit?id='.$task['task']->getId()) ?>'"
			<?php endif ?>	
		
			
			<?php endif ?> 
			>
		<td><?php echo format_date($task['task']->getStart(),'dd.MM.yyyy HH:mm') ?></td>
		<td><?php echo format_date($task['task']->getEnd() ,'dd.MM.yyyy HH:mm') ?></td>

		<td><?php echo $task['task']->getInfo() ?></td>
		<td><?php foreach ($task['task']->getUsers() as $user): ?>
			<?php echo $user ?><br>
		<?php endforeach ?></td>
		<td><?php echo $task['time'] ?></td>
		<td><?php // echo format_date($task['task']->getCreatedAt(),'dd.MM.yyyy') ?>
			<?php echo $task['task']->getCreator()->getUsername() ?>
			</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
			<td ></td>
			<td ></td>
			<th colspan="2">Summe</th>
			<td ><strong><?php echo $worksumme ?></strong></td>

			<td ></td>
		</tr>
	</tfoot>
</table>

<h3 class="job_items_head">Material 

	</h3>
<table class="job_component">
  <thead>
	  <tr>
			<td colspan="2">
				</td>
		</tr>
    <tr>
      <th colspan="2" style="width:150px;">Einheit</th>
      <th style="width:250px;">Artikel</th>
      <th style="width:350px;">Beschreibung</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($entrys as $entry): ?>
    <tr>
		<td><?php echo $entry['amount'] ?> </td>
		<td><?php echo $entry['item']->getUnit()  ?></td>		
		<td><?php echo $entry['item']->getCode() ?></td>
		<td>
		<?php 
		 echo $entry['item']->getDescription();
		 echo $entry['description']; ?></td>
		
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



