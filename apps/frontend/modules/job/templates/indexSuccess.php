<?php  use_helper('Date');?>
<?php use_javascript('jobs.js') ?>

<?php echo link_to('neuer Auftrag','job/new',array('class'=>'button')); ?>
<div class="job_search">
	<ul>
	<li> <?php include_partial('search', array('form' => $formStore)) ?> </li>
	<li> <?php include_partial('search', array('form' => $formCustomer)) ?> </li>
	<ul>
</div>

<div id="jobs">
	

<?php foreach ($jobstate as $state  ): ?>

<div class="job_type_<?php echo $state['type'] ?>_head job_type_head" colspan = "7">
	<?php echo $state['name'] ?> (<?php echo $state['pager']->count() ?>)

</div>

<div class="job_type_<?php echo $state['type'] ?>_body job_type_body" colspan = "7" >
	<?php  include_partial('joblist', array('pager' => $state['pager'], 'url' => $state['url'],'type' => $state['type'])) ?>
</div>
	

<?php endforeach ?>

</div>