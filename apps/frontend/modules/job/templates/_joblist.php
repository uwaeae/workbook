<?php  use_helper('Date');?>
<table class="job job_body_type_<?php echo $type ?>">
  <thead>
    <tr >
		<th>NR</th>
		<th>Kunde</th>
		<th>Filiale</th>
		<th>Adresse</th>
		<th>Auftrag</th>
		<th>Typ</th>
		<th>von</th>
		<th>bis</th>
	<?php if ($type > 1): ?>
		<th>Termin</th>
	<?php endif ?>	
	</tr>
	</thead>
	<tbody >
	<?php foreach ($pager->getResults() as $job): ?>
	<tr class="table_item" 
		onclick="document.location = '<?php echo url_for('/job/show?id='.$job->getId()) ?>'">
		<td><?php echo $job->getID() ?></td>
		<td><?php echo $job->getStore()->getCustomer()->getCompany() ?></td>
		<td><?php echo $job->getStore()->getNumber() ?></td>
		<td><?php echo $job->getStore()->getStreet() ?><br>
		<?php echo sprintf("%1$05d", $job->getStore()->getPostcode()) ?> <?php echo $job->getStore()->getCity() ?></td>
		<td><?php echo substr($job->getDescription(), 0, 50).'...' ?></td>
		<td <?php echo ($job->getJobTypeId() == 1? 'class="fault"':'') ?>><?php echo $job->getJobType() ?></td>
		<td <?php if($job->getStart() < date('c') AND $type < 4)  echo 'class="fault"'; ?>>
		<?php echo format_date($job->getStart(),'dd.MM.yyyy HH:mm') ?></td>
		<td <?php if($job->getEnd() < date('c') AND $type < 4)  echo 'class="fault"'; ?>>
		<?php echo format_date($job->getEnd(),'dd.MM.yyyy HH:mm') ?></td>
		
		<?php if ($type > 1): ?>
		<td >
        <table class="table_list">
            <?php foreach ($job->getTasks() as $thermin ): ?>
            <tr >
                <td <?php if ($job->getEnd()< $thermin->getScheduled() AND $type < 4): ?>
                class="fault"
                <?php endif ?> >
                <?php echo format_date($thermin->getStart(),'dd.MM. HH:mm')  ?>

                </td>
                <td>
                <?php foreach ($thermin->getUsers() as $user):?>
                    <?php echo $user->getUsername()  ?> <br>
                <?php endforeach ?>
                </td>
            </tr>
            <?php endforeach ?>

        </table>
    </td>
		<?php endif ?>
    </tr>


	
	
	
    <?php endforeach; ?>
	<?php if ($pager->haveToPaginate()): ?>
<tr>
	
	<td colspan=" 9">
		
		
	
		<ul class="pageing">
		<li ><?php echo	link_to('<<' ,$url.'&user='.$userID.'&page='.$pager->getFirstPage(),'class=button'); ?></li>
		<li ><?php echo	link_to( '<',$url.'&user='.$userID.'&page='.$pager->getPreviousPage(),'class=button'); ?></li>

		<?php foreach ($pager->getLinks() as $page): ?>
		      <?php if ($page == $pager->getPage()): ?>
		       <li  class="button" >  <?php echo $page ?> </li >
		      <?php else: ?>
		       <li ><?php echo	link_to($page ,$url.'&user='.$userID.'&page='.$page,'class=button'); ?></li>
		      <?php endif; ?>
		<?php endforeach; ?>
		<li ><?php echo	link_to('>' ,$url.'&user='.$userID.'&page='.$pager->getNextPage(),'class=button'); ?></li>
		<li ><?php echo	link_to('>>' ,$url.'&user='.$userID.'&page='.$pager->getLastPage(),'class=button'); ?></li>

		<script type="text/javascript">
		$(document).ready(function(){
         $(".job_body_type_<?php echo $type ?> a").click(function()
			      {
            $(this).closest('div').load($(this).attr("href"));
		        return false;
	        	});
		});
		</script>

    </ul>
		
		
	</td>
	

</tr>
      <?php endif; ?>
  </tbody>
</table>
