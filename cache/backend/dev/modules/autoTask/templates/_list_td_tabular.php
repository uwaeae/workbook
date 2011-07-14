<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($task->getId(), 'task_edit', $task) ?>
</td>
<td class="sf_admin_date sf_admin_list_td_start">
  <?php echo false !== strtotime($task->getStart()) ? format_date($task->getStart(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_end">
  <?php echo false !== strtotime($task->getEnd()) ? format_date($task->getEnd(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_scheduled">
  <?php echo get_partial('task/list_field_boolean', array('value' => $task->getScheduled())) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_break">
  <?php echo $task->getBreak() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_overtime">
  <?php echo $task->getOvertime() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_info">
  <?php echo $task->getInfo() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_approach">
  <?php echo $task->getApproach() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_job_id">
  <?php echo $task->getJobId() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_task_type_id">
  <?php echo $task->getTaskTypeId() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($task->getCreatedAt()) ? format_date($task->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($task->getUpdatedAt()) ? format_date($task->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
