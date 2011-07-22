<form action="<?php echo url_for('file/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> class="fileform">
<?php if (!$form->getObject()->isNew()): ?>

<?php endif; ?>
	<?php echo $form->renderHiddenFields() ?>	
	<input id="job" type="hidden" name="job" value="<?php echo $job ?>">
	<?php echo $form->renderGlobalErrors() ?>
	<?php echo $form['file']->renderError() ?>
	<?php echo $form['file'] ?>
<input class="button" type="submit" value="Speichen" />

</form>