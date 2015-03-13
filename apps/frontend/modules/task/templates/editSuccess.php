<?php use_javascript('task.js') ?>
<?php include_partial('form', array('form' => $form, 'user' => $sf_user,'back' => $back)) ?>
<?php if ($type == 1 ): ?>
	<?php include_partial('entry', array('task' => $task, 'user' => $sf_user)) ?>
<?php endif ?>



