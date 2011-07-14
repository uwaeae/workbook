<td colspan="3">
  <?php echo __('%%id%% - %%name%% - %%file%%', array('%%id%%' => link_to($file->getId(), 'file_edit', $file), '%%name%%' => $file->getName(), '%%file%%' => $file->getFile()), 'messages') ?>
</td>
