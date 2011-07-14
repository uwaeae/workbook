<td colspan="11">
  <?php echo __('%%id%% - %%start%% - %%end%% - %%break%% - %%overtime%% - %%info%% - %%approach%% - %%job_id%% - %%task_type_id%% - %%created_at%% - %%updated_at%%', array('%%id%%' => link_to($task->getId(), 'task_edit', $task), '%%start%%' => false !== strtotime($task->getStart()) ? format_date($task->getStart(), "f") : '&nbsp;', '%%end%%' => false !== strtotime($task->getEnd()) ? format_date($task->getEnd(), "f") : '&nbsp;', '%%break%%' => $task->getBreak(), '%%overtime%%' => $task->getOvertime(), '%%info%%' => $task->getInfo(), '%%approach%%' => $task->getApproach(), '%%job_id%%' => $task->getJobId(), '%%task_type_id%%' => $task->getTaskTypeId(), '%%created_at%%' => false !== strtotime($task->getCreatedAt()) ? format_date($task->getCreatedAt(), "f") : '&nbsp;', '%%updated_at%%' => false !== strtotime($task->getUpdatedAt()) ? format_date($task->getUpdatedAt(), "f") : '&nbsp;'), 'messages') ?>
</td>
