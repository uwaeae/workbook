<?php  use_helper('Date');?>
<?php use_javascript('payroll.js') ?>

<?php include_partial('navform', array('form' => $form )) ?>
<div id="payroll">
	

<table class="payroll" border="0" cellspacing="5" cellpadding="5">

	<thead>
		<tr>
			<th rowspan="2">Datum</th>
			<th rowspan="2">Kunde</th>
		
			<th rowspan="2">Adresse</th>
			<th rowspan="2">Tätigkeit</th>
			<th rowspan="2">FA</th>
			<th colspan="4">Stunden</th>
			<th colspan="2">Korrektur</th>
		</tr>	
			<th>Stunden</th>
			<th>ab 20 Uhr</th>
			<th>Urlaub</th>
			<th>Krank</th>
			<th>Stunden</th>
			<th>Info</th>
		</tr>
	</thead>

<tbody>

<?php foreach ($tasks as $task): ?>
	<?php 	$time = strtotime($task['task']->getEnd()) - strtotime($task['task']->getStart()); ?>
	<tr  class="payrole_entry" 
	onclick="document.location = '<?php echo url_for('task/edit?id='.$task['task']->getId()) ?>'">
		<td><?php 
			if(date('j',$time) > 1) echo 	format_date($task['task']->getStart(),'dd.MM.').
											' - '.
											format_date($task['task']->getEnd(),'dd.MM.yyyy');
			else echo  format_date($task['task']->getStart(),'dd.MM.yyyy'); 
			?></td>
		<td><?php echo $task['task']->getJob()->getStore()->getCustomer()->getCompany() ?></td>
		
		<td><?php echo $task['task']->getJob()->getStore()->getStreet() ?><br>
		<?php echo $task['task']->getJob()->getStore()->getPostcode() ?>
		<?php echo $task['task']->getJob()->getStore()->getCity() ?>
		</td>
		<td><?php echo $task['task']->getInfo() ?></td>
		<td class="number"><?php if(isset($task['approach']))echo $task['approach'] ?></td>
		<td class="number"><?php if(isset($task['worktime'])) echo $task['worktime'] ?></td>
		<td class="number"><?php if($task['task']->getOvertime() != 0) echo $task['task']->getOvertime() ?></td>
		<td class="number"><?php if(isset($task['holyday'])) echo $task['holyday'] ?></td>
		<td class="number"><?php if(isset($task['sickness']))echo $task['sickness'] ?></td>
		<td class="number"><?php echo $task['task']->getCorrectionTime()?></td>
		<td class="number"><?php echo $task['task']->getCorrectionInfo() ?></td>
		

	</tr>
<?php endforeach ?>
</tbody>
<tfoot>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td>Summe</td>
	
	<td class="number"><?php echo $approach ?></td>
	<td class="number"><?php echo $worktime ?></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		
		<td colspan="1">Summe mit FA</td>
		<td colspan="2" class="number"><?php echo $approach+ $worktime  ?></td>
		<td class="number"><?php echo $overtime ?></td>
		<td class="number"><?php echo $holyday ?></td>
		<td class="number"><?php echo $sickness  ?></td>
		<td class="number"><?php echo ($sickness + $holyday+$overtime+$approach+ $worktime) ?></td>	
	</tr>	
	<tr>
		<td colspan="10">
			<?php foreach ($TaskType as $type): ?>
			<?php if ($type->getId() == 1): ?>
			<a class="button" href="<?php echo url_for('job/prenew') ?>"><?php echo $type->getName() ?></a>
			<?php else: ?>
				<a class="button" href="<?php echo url_for('task/new?type='.$type->getId()) ?>"><?php echo $type->getName() ?></a>
			<?php endif ?>
			<?php endforeach ?>
			
		</td>
	</tr>
</tfoot>	
</table>
</div>