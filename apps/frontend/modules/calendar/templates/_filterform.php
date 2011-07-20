<div id="cal_filter">
	<h1  class="cal_filter_head cal_filter_opener ">
		Filter
	</h1>		
	<div class="cal_filter_body" >
		<form action="<?php echo url_for('calendar/'.$type) ?>" method="post" >
		<div class="filtertypes">
	
		
		<?php echo $form['type']->renderRow()  ?>
		</div>
	<?php if ( $sf_user->hasGroup('admin') OR $sf_user->hasGroup('supervisor')) : ?>
		<div class="filterusers">
		<?php echo $form['user']->renderRow()  ?>
		</div>
	<?php endif ?>
	</form>
	</div>
</div>