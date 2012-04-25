<?php  use_helper('Date');?>
<?php use_javascript('jobs.js') ?>

<?php echo link_to('neuer Auftrag','job/new',array('class'=>'button')); ?>
<div class="job_search">
	<ul>
	<li> <?php include_partial('search', array('form' => $formStore)) ?> </li>
	<li> <?php include_partial('search', array('form' => $formCustomer)) ?> </li>
	<ul>
</div>

<div id="job">


    <div class="job_type_0">
        <div class="job_type_head_0 job_type_head" colspan = "7">
            <?php echo $jobs_own['name'] ?> (<?php echo $jobs_own['count'] ?>)
        </div>
        <div class="job_type_body_0 job_type_body" colspan = "7" > </div>
    </div>


    <div class="job_type_1">
        <div class="job_type_head_1 job_type_head" colspan = "7">
            <?php echo $jobs_open['name'] ?> (<?php echo $jobs_open['count'] ?>)
        </div>
        <div class="job_type_body_1 job_type_body" colspan = "7" > </div>
    </div>

    <div class="job_type_2">

    <?php foreach($jobs_sheduled as $job_sh): ?>

        <div class="job_type_head_<?php echo $job_sh['id'] ?>  job_type_head" colspan = "7">
            <?php echo $job_sh['name'] ?> (<?php echo $job_sh['count'] ?>)
        </div>


        <div class="job_type_body_<?php echo $job_sh['id'] ?> job_type_body" colspan = "7" > </div>



    <script type="text/javascript">
        $('div.job_type_head_<?php echo $job_sh['id'] ?> ').click(function(key)
        {

            $(this).parent().find('.job_type_body_<?php echo $job_sh['id'] ?>').load('/job/table/type/2/user/<?php echo $job_sh['id'] ?>' ); //.slideToggle('slow');
           // $(this).parent().find('.job_type_body_<?php echo $job_sh['id'] ?>').toggle();

        });



    </script>
    <?php endforeach ?>


    </div>

    <div class="job_type_3">
        <div class="job_type_head_3 job_type_head" colspan = "7">
            <?php echo $job_worked['name'] ?> (<?php echo $job_worked['count'] ?>)
        </div>
        <div class="job_type_body_3 job_type_body" colspan = "7" > </div>
    </div>

    <div class="job_type_4">
        <div class="job_type_head_4 job_type_head" colspan = "7">
            <?php echo $jobs_finisched['name'] ?> (<?php echo $jobs_finisched['count'] ?>)
        </div>
        <div class="job_type_body_4 job_type_body" colspan = "7" > </div>
    </div>












</div>
