<div id="cal_filter">
	<h1  class="cal_filter_head cal_filter_opener ">
		Filter
	</h1>		
	<div class="cal_filter_body" >
		<form action="<?php echo url_for('calendar/'.$type) ?>" method="post" >
		<div class="filtertypes">
	
		<?php echo $form['type']->renderError()  ?>
		<?php echo $form['type']->render()  ?>
		</div>
		<div class="filterusers">
		
		<?php echo $form['user']->renderError()  ?>
		<?php echo $form['user']->render()  ?>
		</div>

	</form>
	</div>
</div>