<?php use_helper('I18N', 'Date') ?>
<?php include_partial('task/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New Task', array(), 'messages') ?></h1>

  <?php include_partial('task/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('task/form_header', array('task' => $task, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('task/form', array('task' => $task, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('task/form_footer', array('task' => $task, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
