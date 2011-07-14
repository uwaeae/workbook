<?php use_helper('I18N', 'Date') ?>
<?php include_partial('jobtype/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New Jobtype', array(), 'messages') ?></h1>

  <?php include_partial('jobtype/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('jobtype/form_header', array('jobtype' => $jobtype, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('jobtype/form', array('jobtype' => $jobtype, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('jobtype/form_footer', array('jobtype' => $jobtype, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
