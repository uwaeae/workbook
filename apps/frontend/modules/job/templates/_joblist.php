<?php  use_helper('Date');?>
<table class="job">
  <thead>
    <tr class="job_type_<?php echo $type ?>_body">
		<th>Kunde</th>
		<th>Filiale</th>
		<th>Adresse</th>
		<th>Auftrag</th>
		<th>Typ</th>
		<th>bis zum</th>
	<?php if ($type > 1): ?>
		<th>Termin</th>
	<?php endif ?>	
	</tr>
	</thead>
	<tbody class="job_type_<?php echo $type ?>_body">
	<?php foreach ($pager->getResults() as $job): ?>
	<tr class="table_item" 
		onclick="document.location = '<?php echo url_for('job/show?id='.$job->getId()) ?>'">
		<td><?php echo $job->getStore()->getCustomer()->getCompany() ?></td>
		<td><?php echo $job->getStore()->getNumber() ?></td>
		<td><?php echo $job->getStore()->getStreet() ?><br>
		<?php echo $job->getStore()->getPostcode() ?> <?php echo $job->getStore()->getCity() ?></td>
		<td><?php echo substr($job->getDescription(), 0, 50).'...' ?></td>
		<td><?php echo $job->getJobType() ?></td>
		<td <?php if($job->getEnd() < date('c') AND $type < 4)  echo 'class="fault"'; ?>>
		<?php echo format_date($job->getEnd(),'dd.MM.yyyy HH:mm') ?></td>
		
		<?php if ($type > 1): ?>
		<td ><?php foreach ($job->getTasks() as $thermin ): ?> 
		<ul class="table_list">	
			<span <?php if ($job->getEnd()< $thermin->getScheduled() AND $type < 4): ?>
				class="fault"
			<?php endif ?> >
		<?php echo format_date($thermin->getStart(),'dd.MM.yyyy HH:mm')  ?>
		</span>
			
		<?php 
			foreach ($thermin->getUsers() as $user) {
				echo '<li >'.$user->getUsername().'</li>';
			}
		 ?>
		</ul>	<?php endforeach ?></td>
		<?php endif ?>
    </tr>


	
	
	
    <?php endforeach; ?>
<tr>
	
	<td colspan=" 7">
		
		
		<?php if ($pager->haveToPaginate()): ?>
		<ul class="pageing">
		<li ><?php echo	link_to('<<' ,$url.'&page='.$pager->getFirstPage(),'class=button'); ?></li>	
		<li ><?php echo	link_to( '<',$url.'&page='.$pager->getPreviousPage(),'class=button'); ?></li>

		<?php foreach ($pager->getLinks() as $page): ?>
		      <?php if ($page == $pager->getPage()): ?>
		       <li  class="button" >  <?php echo $page ?> </li >
		      <?php else: ?>
		       <li ><?php echo	link_to($page ,$url.'&page='.$page,'class=button'); ?></li>
		      <?php endif; ?>
		<?php endforeach; ?>
		<li ><?php echo	link_to('>' ,$url.'&page='.$pager->getNextPage(),'class=button'); ?></li>
		<li ><?php echo	link_to('>>' ,$url.'&page='.$pager->getLastPage(),'class=button'); ?></li>
		</ul>
		<script type="text/javascript">
		$(document).ready(function(){
		 $(".job_type_<?php echo $type ?>_body a").click(function()
			{
			$('.job_type_<?php echo $type ?>_head #loader').show();	
			$('.job_type_<?php echo $type ?>_body').load($(this).attr("href"),function() {
				$('.job_type_<?php echo $type ?>_head #loader').hide();
				});
			return false;

			});

		});
		</script>

		<?php endif; ?>
		
		
	</td>
	

</tr>
  </tbody>
</table>
