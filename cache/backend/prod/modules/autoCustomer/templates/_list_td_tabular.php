<td class="sf_admin_text sf_admin_list_td_number">
  <?php echo link_to($customer->getNumber(), 'customer_edit', $customer) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_company">
  <?php echo link_to($customer->getCompany(), 'customer_edit', $customer) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_stores">
  <?php echo get_partial('customer/stores', array('type' => 'list', 'customer' => $customer)) ?>
</td>
