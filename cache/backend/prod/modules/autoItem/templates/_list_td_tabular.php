<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($item->getId(), 'item_edit', $item) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_code">
  <?php echo $item->getCode() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <?php echo $item->getName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_unit">
  <?php echo $item->getUnit() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_description">
  <?php echo $item->getDescription() ?>
</td>
