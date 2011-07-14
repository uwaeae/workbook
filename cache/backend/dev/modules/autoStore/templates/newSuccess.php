<?php use_helper('I18N', 'Date') ?>
<?php include_partial('store/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New Store', array(), 'messages') ?></h1>

  <?php include_partial('store/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('store/form_header', array('store' => $store, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('store/form', array('store' => $store, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('store/form_footer', array('store' => $store, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
