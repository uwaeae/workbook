<td colspan="3">
  <?php echo __('%%number%% - %%company%% - %%stores%%', array('%%number%%' => link_to($customer->getNumber(), 'customer_edit', $customer), '%%company%%' => link_to($customer->getCompany(), 'customer_edit', $customer), '%%stores%%' => get_partial('customer/stores', array('type' => 'list', 'customer' => $customer))), 'messages') ?>
</td>
