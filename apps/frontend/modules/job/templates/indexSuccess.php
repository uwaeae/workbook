<?php  use_helper('Date');?>
<?php use_javascript('jobs.js') ?>
<div class="job_search">
	<ul>
	<li> <?php include_partial('search', array('form' => $formStore)) ?> </li>
	<li> <?php include_partial('search', array('form' => $formCustomer)) ?> </li>
	<ul>
</div>
<?php foreach ($jobstate as $state ): ?>

<div class="job_type_<?php echo $state['type'] ?>_head job_type_head" colspan = "7">
	<?php echo $state['Name'] ?>
</div>

<div class="job_type_<?php echo $state['type'] ?>_body job_type_body" colspan = "7">

</div>
	

<?php endforeach ?>

