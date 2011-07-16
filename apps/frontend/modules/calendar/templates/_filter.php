<div id="cal_filter">
	<h1  class="cal_filter_head cal_filter_opener ">
		Filter
	</h1>		
	<div >
		

	<ul>

			<li class="cal_filter_item cal_type_1">
				<a class="calendar_type_button" href="<?php echo url_for('calendar/'.$type.'/?next='.$next.'&user='.$userid.'&type=0') ?>">
					Alle</a>
			</li>
			<li class="cal_filter_item cal_type_1_finshed">
				<a class="cal_type_button" href="<?php echo url_for('calendar/'.$type.'/?next='.$next.'&user='.$userid.'&type=1') ?>">
				Arbeit</a>
			</li>
			<li class="cal_filter_item  cal_type_2">
				<a class="cal_type_button" href="<?php echo url_for('calendar/'.$type.'/?next='.$next.'&user='.$userid.'&type=2') ?>">
				Krank</a>
			</li>
			<li class="cal_filter_item  cal_type_3">
				<a class="cal_type_button " href="<?php echo url_for('calendar/'.$type.'/?next='.$next.'&user='.$userid.'&type=3') ?>">
				Urlaub</a>
			</li>
</ul>		
<?php if ( $sf_user->hasGroup('admin') OR $sf_user->hasGroup('supervisor')) : ?>
	<ul>
	<form action="<?php echo url_for('calendar/'.$type.'/?next='.$next) ?>">
		<li>
			<input type="checkbox" <?php if($userid == 0)  echo "checked" ?> 
				 Alle 
		</li>		
		<?php foreach ($users as $user): ?>
			<input type="checkbox" <?php if($userid == $user->getId())  echo "checked" ?> >
				 
				 <?php echo $user->getUsername() ?>	
			
			</li>
	<?php endforeach ?>
	  </select>	
	</form>
	<?php endif ?>		
	</ul>
</div>
</div>