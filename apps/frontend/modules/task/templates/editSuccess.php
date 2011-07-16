
<?php include_partial('form', array('form' => $form, 'user' => $sf_user)) ?>

<a href="<?php echo url_for('job/show/?id='.$job->getId()) ?>">Zurück</a>
