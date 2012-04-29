<?php  use_helper('Date');?>
<?php use_javascript('jobshow.js') ?>

<div class="job_openjob_menu">

    <ul>
        <li>
            <?php include_partial('openjob', array('jobs' => $openjobs_near,'type'=> 'open_jobs','info'=> 'Offene Aufträge  in der Nähe')) ?>
        </li>
        <li>
            <?php include_partial('openjob', array('jobs' => $openjobs_same,'type'=> 'open_jobs','info'=> 'Offene Aufträge  in der Filiale')) ?>
        </li>
        <li>
            <?php include_partial('openjob', array('jobs' => $jobsold,'type'=> 'open_jobs','info'=> 'Erledigte Aufträge')) ?>
        </li>
    </ul>




</div>


<table class="job_show">
  <tbody>
    <tr>
      <th>Auftragsnummer </th>
      <td><?php echo $job->getId() ?></td>
	<th>Status: </th>
      <td><?php echo $job->getJobState() ?></td>
	<th>Typ:</th>
      <td <?php echo ($job->getJobTypeId() == 1? 'class="fault"':'') ?>><?php echo $job->getJobType() ?></td>
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
      <td colspan="2" ><?php echo $job->getStore()->getCustomer()->getCompany() ?></td>
      <th>Filiale</th>
      <td colspan="1" >
          <?php echo ($job->getStore()->getNumber()!=0 ?$job->getStore()->getNumber():' ')  ?></td>

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
						<?php echo link_to('Delete', 'file/delete?id='.$file->getID().'&jobid='.$job->getID(), array('method' => 'delete', 'confirm' => 'Are you sure?','class'=>'button','style'=> 'float:right;')) ?></li>
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
		<th>zuletzt bearbeitet am</th>
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
				<?php if ($sf_user->hasPermission('Bearbeiten')  ): ?>
				
			<li class="table_menu_left">
						
		<a class="button" href="<?php echo url_for('job/edit?id='.$job->getId()) ?>">
				ändern</a></li>
			
				<?php endif ?>
				
		</ul>	
		</td>
		<td>
			
    		
		<?php if ($job->getJobStateId() == 2 AND $job->getInvoices()->count() == 0 AND $sf_user->hasPermission('Rechnung') ): ?>
				<a class="button" href="<?php echo url_for('invoice/new/?job='.$job->getId()) ?>">
				Rechnungsnummer erstellen</a>
				<a href="<?php echo url_for( 'job/finish/?id='.$job->getId()) ?>" 
					onclick="return confirm('Sind sie sicher das sie den Auftrag Nummer <?php echo $job->getId() ?> wieder einstellen möchten?');" 
					class="button" >
					Auftrag wieder einstellen 
				</a>
		<?php endif ?>
		<?php  if($job->getJobStateId() == 1): ?>
			<a href="<?php echo url_for( 'job/finish/?id='.$job->getId()) ?>" 
				onclick="return confirm('Sind sie sicher das sie den Auftrag Nummer <?php echo $job->getId() ?> abschliesen möchten?');" 
				class="button" >
				<img src="/images/icons/tick.png"  />Auftrag abschließen
			</a>
		<?php endif ?>
	</tr>
	</tfood>	
</table>

<hr />


<h3 class="job_work" >Termin 	</h3>
	<?php if ($job->getJobStateId() < 2): ?> 
				<a class="button" href="<?php echo url_for('task/new/?job='.$job->getId().'&type=0') ?>">	
				Termin planen</a></li>
	<?php endif ?>
<table class="job_component">
  <thead>
	<tr>
	<th style="width:150px;">Start</th>
	<th style="width:150px;">Ende</th>
	<th style="width:200px;">eingeplant</th>
	<th style="width:200px;">erstellt</th>
	<th style="width:200px;"></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($job->getTasks() as $task): ?>
<?php if ($task->getScheduled()): ?>
	
  
<tr class="table_item">
		<td><?php echo format_date($task->getStart(),'dd.MM.yyyy HH:mm') ?></td>
		<td><?php echo format_date($task->getEnd() ,'dd.MM.yyyy HH:mm') ?></td>
		<td><?php foreach ($task->getUsers() as $user): ?>
			<?php echo $user ?><br>
		<?php endforeach ?></td>
		<td><?php echo format_date($task->getCreatedAt(),'dd.MM.yyyy HH:mm') ?>
			<?php echo $task->getCreator()->getUsername() ?>
		</td>
		<td>
		<?php if ($job->getJobStateId() < 2): ?> 
			
		
		
			<a class="button" href="<?php echo url_for('task/edit?id='.$task->getId().'&type=0') ?>">
		Bearbeiten</a>
		<?php if ($task->hasUser($sf_user->getId())):?>
				<a class="button" href="<?php echo url_for('task/edit?id='.$task->getId().'&type=1') ?>">
				Ausgeführt</a>
		<?php endif ?> 
		<?php endif ?> 
		</td>
	</tr>
	<?php endif ?>  
    <?php endforeach; ?>
  </tbody>
</table>



<h3 class="job_work" >Arbeiten </h3>
	<?php if ($job->getJobStateId() < 2): ?> 
	 <a class="button" href="<?php echo url_for('task/new/?job='.$job->getId()) ?>">
	 neue Arbeit </a>

		
	<?php endif ?>

<table class="job_component">
  <thead>
   
	<tr>
	<th rowspan="2" style="width:150px;">Start</th>
	<th rowspan="2" style="width:150px;">Ende</th>

	<th rowspan="2" style="width:350px;">Arbeiten</th>
	<th rowspan="2" style="width:200px;">Mitarbeiter</th>
	<th colspan="2"style="width:50px;">Stunden</th>
<?php if ( $sf_user->hasGroup('admin')): ?>
	<th rowspan="2" style="width:150px;">Bearbeitet</th>
<?php endif ?>
  </tr>
	<tr>
	<th rowspan="2" style="width:150px;">Normal </th>
	<th rowspan="2" style="width:150px;">30%</th>
	</tr>
	</thead>
	<tbody>
<?php foreach ($work as $task): ?>
		<tr class="table_item"
			onclick="document.location='<?php echo url_for('task/'.(($task['task']->hasUser($sf_user->getId()) OR $sf_user->hasGroup('admin')) ?'edit':'show').'?id='.$task['task']->getId()) ?>'"		>
		<td><?php echo format_date($task['task']->getStart(),'dd.MM.yyyy HH:mm') ?></td>
		<td><?php echo format_date($task['task']->getEnd() ,'dd.MM.yyyy HH:mm') ?></td>

		<td><?php echo $task['task']->getInfo() ?></td>
		<td><?php foreach ($task['task']->getUsers() as $user): ?>
			<?php echo $user ?><br>
		<?php endforeach ?></td>
		<td><?php echo $task['time'] ?></td>
		<td><?php echo $task['task']->getOvertime() ?></td>
<?php if ( $sf_user->hasGroup('admin')): ?>
    <td>
        <?php echo $task['task']->getUpdater()->getUsername() ?>
        <?php echo format_date($task['task']->getUpdatedAt(),'dd.MM.yyyy HH:MM') ?>
     </td>
<?php endif ?>
	</tr>
<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2" rowspan="2"></td>
			<th colspan="1" rowspan="2">Summe</th>
			<th colspan="1" rowspan="1">Einzeln</th>
			<td ><strong><?php echo $worksumme ?></strong></td>
			<td ><strong><?php echo $overtimesumme ?></strong></td>
			<td ></td>
		</tr>
		<tr>
			<th colspan="1" rowspan="1" >Gesamt</th>
			<td colspan="2" style="text-align: center;"><strong><?php echo $worksumme+$overtimesumme  ?></strong></td>
			

			<td ></td>
		</tr>
	</tfoot>
</table>

<h3 class="job_work">Material 

	</h3>
<table class="job_component">
  <thead>
	
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



