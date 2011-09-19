<?php if ($pager->haveToPaginate()): ?>
<ul class="pageing">
<li ><?php echo	link_to('<<' ,$url.'/?page='.$pager->getFirstPage(),'class=button'); ?></li>	
<li ><?php echo	link_to( '<',$url.'/?page='.$pager->getPreviousPage(),'class=button'); ?></li>

<?php foreach ($pager->getLinks() as $page): ?>
      <?php if ($page == $pager->getPage()): ?>
       <li  class="button" >  <?php echo $page ?> </li >
      <?php else: ?>
       <li ><?php echo	link_to($page ,$url.'/?page='.$page,'class=button'); ?></li>
      <?php endif; ?>
<?php endforeach; ?>
<li ><?php echo	link_to('>' ,$url.'/?page='.$pager->getNextPage(),'class=button'); ?></li>
<li ><?php echo	link_to('>>' ,$url.'/?page='.$pager->getLastPage(),'class=button'); ?></li>
</ul>
<script type="text/javascript">
$(document).ready(function(){
 $(".job_type_<?php echo $type ?>_body a").click(function()
	{

	$('.job_type_<?php echo $type ?>_body').load($(this).attr("href"),function() {
		 // $('.job_type_2_body').fadeIn();
		});
	return false;

	});

});
</script>

<?php endif; ?>
