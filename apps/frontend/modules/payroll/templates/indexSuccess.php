<?php  use_helper('Date');

?>



<table border="0" cellspacing="5" cellpadding="5">

	<thead>
		<tr><td>
		<?php foreach ($taskmonth as $m): ?>
			<?php echo $m->month ?>
		<?php endforeach ?>
		</td>
		</tr>
	</thead>

<tbody>
	<tr>
		<th rowspan="2">Datum</th>
		<th rowspan="2">Kunde</th>
		<th rowspan="2">Filiale</th>
		<th rowspan="2">Adresse</th>
		<th rowspan="2">Tätigkeit</th>
		<th rowspan="2">FA</th>
		<th colspan="4">Stunden</th>
	</tr>	
		<th>Stunden</th>
		<th>ab 20 Uhr</th>
		<th>Krank</th>
		<th>Urlaub</th>
	</tr>
<?php foreach ($tasks as $task): ?>
	<?php 	$time = strtotime($task['task']->getEnd()) - strtotime($task['task']->getStart()); ?>
	<tr  class="table_item" 
	onclick="document.location = '<?php echo url_for('task/edit?id='.$task['task']->getId()) ?>'">
		<td><?php 
			if(date('j',$time) > 1) echo 	format_date($task['task']->getStart(),'dd.MM.').
											' - '.
											format_date($task['task']->getEnd(),'dd.MM.yyyy');
			else echo  format_date($task['task']->getStart(),'dd.MM.yyyy'); 
			?></td>
		<td><?php echo $task['task']->getJob()->getStore()->getCustomer()->getCompany() ?></td>
		<td><?php echo $task['task']->getJob()->getStore()->getNumber() ?></td>
		<td><?php echo $task['task']->getJob()->getStore()->getStreet() ?><br>
		<?php echo $task['task']->getJob()->getStore()->getPostcode() ?>
		<?php echo $task['task']->getJob()->getStore()->getCity() ?>
		</td>
		<td><?php echo $task['task']->getInfo() ?></td>
		<td><?php echo $task['task']->getApproach() * 0.15 ?></td>
		<td><?php if(isset($task['worktime'])) echo $task['worktime'] ?></td>
		<td><?php  echo $task['task']->getOvertime() ?></td>
		<td><?php if(isset($task['holyday'])) echo $task['holyday'] ?></td>
		<td><?php if(isset($task['sickness']))echo $task['sickness'] ?></td>
		

	</tr>
<?php endforeach ?>
</tbody>
<tfood>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<th>Summe</th>
		<td><?php echo $worktime ?></td>
		<td><?php echo $overtime ?></td>
		<td><?php echo $holyday ?></td>
		<td><?php echo $sickness  ?></td>
		<td><?php echo ($sickness + $holyday+$overtime+ $worktime) ?></td>	
	</tr>	
	<tr>
		<td colspan="3">
			<a class="button" href="<?php echo url_for('task/new?type=1') ?>">Arbeit</a>
			<a class="button" href="<?php echo url_for('task/new?type=2') ?>">Krank</a>
			<a class="button" href="<?php echo url_for('task/new?type=3') ?>">Urlaub</a>
			
		</td>
	</tr>
</tfood>	
</table>
