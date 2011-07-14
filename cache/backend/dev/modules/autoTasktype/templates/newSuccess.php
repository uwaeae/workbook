<?php use_helper('I18N', 'Date') ?>
<?php include_partial('tasktype/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New Tasktype', array(), 'messages') ?></h1>

  <?php include_partial('tasktype/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('tasktype/form_header', array('task_type' => $task_type, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('tasktype/form', array('task_type' => $task_type, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('tasktype/form_footer', array('task_type' => $task_type, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
