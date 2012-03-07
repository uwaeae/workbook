<div class="payroll_nav">
	
		<form action="<?php echo url_for('payroll/index') ?>" method="get" >
		<div id="name">
      <?php echo $form['year']->renderRow()  ?>
			<?php echo $form['month']->renderRow()  ?>
		</div>
		
	
			<?php if (isset($form['user'])): ?>
				<div id="name">
				<?php echo $form['user']->renderRow()  ?>
					</div>
			<?php endif ?>
				
	
	
		</form>
		<?php if ( $sf_user->hasGroup('admin') OR $sf_user->hasGroup('supervisor')) : ?>
		<?php endif ?>
</div>