<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($job->getId(), 'job_edit', $job) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_contact_person">
  <?php echo $job->getContactPerson() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_contact_info">
  <?php echo $job->getContactInfo() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_job_type_id">
  <?php echo $job->getJobTypeId() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_end">
  <?php echo false !== strtotime($job->getEnd()) ? format_date($job->getEnd(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_start">
  <?php echo false !== strtotime($job->getStart()) ? format_date($job->getStart(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_timeed">
  <?php echo false !== strtotime($job->getTimeed()) ? format_date($job->getTimeed(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_description">
  <?php echo $job->getDescription() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_timeinterval">
  <?php echo $job->getTimeinterval() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_job_state_id">
  <?php echo $job->getJobStateId() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_store_id">
  <?php echo $job->getStoreId() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($job->getCreatedAt()) ? format_date($job->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($job->getUpdatedAt()) ? format_date($job->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
