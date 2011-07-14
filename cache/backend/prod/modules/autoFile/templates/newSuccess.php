<?php use_helper('I18N', 'Date') ?>
<?php include_partial('file/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New File', array(), 'messages') ?></h1>

  <?php include_partial('file/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('file/form_header', array('file' => $file, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('file/form', array('file' => $file, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('file/form_footer', array('file' => $file, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
