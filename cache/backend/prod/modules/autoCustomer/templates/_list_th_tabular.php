<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_number">
  <?php if ('number' == $sort[0]): ?>
    <?php echo link_to(__('Kundennummer', array(), 'messages'), '@customer', array('query_string' => 'sort=number&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Kundennummer', array(), 'messages'), '@customer', array('query_string' => 'sort=number&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_company">
  <?php if ('company' == $sort[0]): ?>
    <?php echo link_to(__('Firmenname', array(), 'messages'), '@customer', array('query_string' => 'sort=company&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Firmenname', array(), 'messages'), '@customer', array('query_string' => 'sort=company&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_stores">
  <?php echo __('Stores', array(), 'messages') ?>
</th>
<?php end_slot(); ?>
<?php include_slot('sf_admin.current_header') ?>