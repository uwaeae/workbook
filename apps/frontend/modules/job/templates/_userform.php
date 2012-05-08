<form action="<?php echo url_for('job/user') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> class="JobUser_Form">
    <?php echo $form->renderHiddenFields() ?>
    <?php echo $form->renderGlobalErrors() ?>
    <?php echo $form['user']->renderError() ?>
    <?php echo $form['user'] ?>
    <input class="button" type="submit" value="Zuweisen" />

</form>