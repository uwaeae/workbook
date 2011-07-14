
<div id="open_job">
<table>
  <thead>
    <tr>
		<th class="cal_open_jobs_head" colspan="3"> Offene Aufträge</th>
	</tr>
	</thead>
	<tbody class="cal_open_jobs_body" >
	<?php foreach ($jobs as $job): ?>
	<tr class="cal_oen_jobs_item" 	onclick="document.location = '<?php if ($sf_user->hasPermission('Zuweisen')) echo url_for('task/new/?job='.$job->getId().'&type=0') ?>'">
		<td><?php echo $job->getId()?><br>
		Ende: <?php echo format_date($job->getEnd(),'dd.MM.') ?><br>
		Anfang: <?php echo format_date($job->getStart(),'dd.MM.') ?>
		</td>
		<td><p><?php echo $job->getStore()->getCustomer()->getCompany() ?></p>
		<p> <?php echo $job->getStore()->getStreet() ?><br>
		<?php echo $job->getStore()->getPostcode() ?><?php echo $job->getStore()->getCity() ?></p>
		<p>
			<?php echo substr($job->getDescription(), 0, 50) ?>
		</p>
		
		
    </tr>

    <?php endforeach; ?>
  </tbody>
</table>
</div>