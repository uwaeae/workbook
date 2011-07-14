<?php use_helper('I18N', 'Date') ?>
<?php include_partial('itemtyp/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New Itemtyp', array(), 'messages') ?></h1>

  <?php include_partial('itemtyp/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('itemtyp/form_header', array('item_typ' => $item_typ, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('itemtyp/form', array('item_typ' => $item_typ, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('itemtyp/form_footer', array('item_typ' => $item_typ, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
