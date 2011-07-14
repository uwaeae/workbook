<?php use_helper('I18N', 'Date') ?>
<?php include_partial('customer/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Bearbeiten von %%company%%', array('%%company%%' => $customer->getCompany()), 'messages') ?></h1>

  <?php include_partial('customer/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('customer/form_header', array('customer' => $customer, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('customer/form', array('customer' => $customer, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('customer/form_footer', array('customer' => $customer, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
