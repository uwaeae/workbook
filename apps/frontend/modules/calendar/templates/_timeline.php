<table border="0" class="cal_table_<?php echo $type ?>">
<?php foreach ($time as $t): ?>
	
	<tr class="cal_timerow_<?php echo (($t%2) == 1? 'even': 'odd')  ?> " > 
		<td><?php echo $t ?>:00</td>
	</tr> 
<?php endforeach ?>
</table></div>