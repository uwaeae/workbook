<?php  use_helper('Date');?>
<div class="job_search">
	<ul>
	<li> <?php include_partial('search', array('form' => $formStore)) ?> </li>
	<li> <?php include_partial('search', array('form' => $formCustomer)) ?> </li>
	<ul>
</div>
<table class="job">
  <thead>
    <tr>
      <th>Kunde</th>
      <th>Auftrag</th>
      <th>Rechnungsnummer</th>
      <th>Erledigt am</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $job): ?>
    <tr 	class="table_item"
			onclick="document.location = '<?php echo url_for('job/show?id='.$job->getId()) ?>'">
      <td><?php echo $job->getStore()->getCustomer()->getCompany() ?><br>
      <?php echo $job->getStore()->getStreet() ?><br>
      <?php echo $job->getStore()->getPostcode()  ?>
      <?php echo $job->getStore()->getCity()  ?></td>
      <td><?php echo substr($job->getDescription(),0,50) ?></td>
      <td>	
			<?php foreach ($job->getInvoices() as $invoice): ?>
				<?php echo $invoice->getNumber() ?>
			<?php endforeach ?>
	  </td>
      <td>
			<?php foreach ($job->getTasks()  as $task): ?>
				<?php echo format_date($task->getStart() ,'dd.MM.yyyy') ?>
			<?php endforeach ?>
		</td>

	  
    </tr>

    <?php endforeach; ?>
  </tbody>


	

</table>

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



