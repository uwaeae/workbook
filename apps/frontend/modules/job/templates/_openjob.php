
<div id="<?php echo $type ?>">
<h1 class="<?php echo $type ?>_head">(<?php echo count($jobs)  ?>) <?php echo $info ?></h1>

<div class="<?php echo $type ?>_body">
	

<ul >
	
	<?php foreach ($jobs as $job): ?>
	
	
	<li class="<?php echo $type ?>_item" 	onclick="document.location = '<?php  echo url_for('job/show?id='.$job->getId()) ?>'">
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