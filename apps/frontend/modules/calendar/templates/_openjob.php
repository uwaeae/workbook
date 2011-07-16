
<div id="open_job">
<h1 class="cal_open_jobs_head">Offene Aufträge</h1>

<div class="cal_open_jobs_body">
	

<ul >
	
	<?php foreach ($jobs as $job): ?>
	
	
	<li class="cal_oen_jobs_item" 	onclick="document.location = '<?php if ($sf_user->hasPermission('Zuweisen')) echo url_for('task/new/?job='.$job->getId().'&type=0') ?>'">
	<?php echo $job->getId()?><br>
		Ende: <?php echo format_date($job->getEnd(),'dd.MM.') ?><br>
		Anfang: <?php echo format_date($job->getStart(),'dd.MM.') ?>
		
	<p><?php echo $job->getStore()->getCustomer()->getCompany() ?></p>
		<p> <?php echo $job->getStore()->getStreet() ?><br>
		<?php echo $job->getStore()->getPostcode() ?><?php echo $job->getStore()->getCity() ?></p>
		<p>
			<?php echo substr($job->getDescription(), 0, 50) ?>
		</p>
		
		
    </li>

    <?php endforeach; ?>
<ul>
</div>
</div>