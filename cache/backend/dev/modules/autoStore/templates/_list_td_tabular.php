<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($store->getId(), 'store_edit', $store) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_number">
  <?php echo $store->getNumber() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_contact">
  <?php echo $store->getContact() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_info">
  <?php echo $store->getInfo() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_street">
  <?php echo $store->getStreet() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_city">
  <?php echo $store->getCity() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_country">
  <?php echo $store->getCountry() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_destrict">
  <?php echo $store->getDestrict() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_fon">
  <?php echo $store->getFon() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_fax">
  <?php echo $store->getFax() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_postcode">
  <?php echo $store->getPostcode() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_customer_id">
  <?php echo $store->getCustomerId() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($store->getCreatedAt()) ? format_date($store->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($store->getUpdatedAt()) ? format_date($store->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
