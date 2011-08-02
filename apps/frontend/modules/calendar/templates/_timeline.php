<?php $even = true ?>
<table border="0" class="cal_timeline cal_table_<?php echo $type ?>">
	<tr class="cal_table_head">
		<th></th>
	</tr>	
<?php foreach ($time as $t): ?>
	
	<tr class="cal_timerow_<?php if($even) {
								echo 'odd';
								$even = false;
								} 
							else {
								echo 'even';
								$even = true;} ?>" " > 
		<td><?php echo $t ?>:00</td>
	</tr> 
<?php endforeach ?>
</table></div>