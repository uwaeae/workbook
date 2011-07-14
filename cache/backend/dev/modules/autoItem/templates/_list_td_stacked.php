<td colspan="5">
  <?php echo __('%%id%% - %%code%% - %%name%% - %%unit%% - %%description%%', array('%%id%%' => link_to($item->getId(), 'item_edit', $item), '%%code%%' => $item->getCode(), '%%name%%' => $item->getName(), '%%unit%%' => $item->getUnit(), '%%description%%' => $item->getDescription()), 'messages') ?>
</td>
