<div id="cal_filter">
		<ul>
			<li  class="cal_filter_head cal_filter_opener ">
				Filter
			</li>
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
		
<?php if ( $sf_user->hasGroup('admin') OR $sf_user->hasGroup('supervisor')) : ?>
				<li  class="cal_filter_head">
					User
				</li>	
			<li class="cal_filter_item   cal_user <?php if($userid == 0)  echo "button_selected" ?>">
				<a class="cal_type_button " href="<?php echo url_for('calendar/'.$type.'/?next='.$next.'&user=0') ?>">
				 Alle 
				</a>
			</li>	
		<?php foreach ($users as $user): ?>
			<li class="cal_filter_item  cal_user<?php if($userid == $user->getId())  echo " button_selected" ?> ">
				<a class='cal_type_button' href="<?php echo url_for('calendar/'.$type.'/?next='.$next.'&user='.$user->getId()) ?>">
				 <?php echo $user->getUsername() ?>	
				</a>
			</li>
	<?php endforeach ?>
	
<?php endif ?>		
</ul>

</div>