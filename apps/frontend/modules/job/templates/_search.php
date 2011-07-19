<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<form action="<?php echo url_for('job/search') ?>" method="get" accept-charset="utf-8">
	<?php echo $form ?>

	<input type="submit" value="Search">
</form>

