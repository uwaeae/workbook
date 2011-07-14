<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($customer->getId(), 'customer_edit', $customer) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_company">
  <?php echo $customer->getCompany() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_logo">
  <?php echo $customer->getLogo() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_url">
  <?php echo $customer->getUrl() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_number">
  <?php echo $customer->getNumber() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_headoffice">
  <?php echo $customer->getHeadoffice() ?>
</td>
