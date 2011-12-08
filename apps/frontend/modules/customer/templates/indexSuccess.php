<h1>Kunden </h1>
<div class="job_search">
	<ul>
	<li> <?php include_partial('search', array('form' => $formStore)) ?> </li>
	<li> <?php include_partial('search', array('form' => $formCustomer)) ?> </li>
	
	<ul>
</div>

<table class="job">
  <thead>
	<tr><td colspan="4">
	<a class="button" href="<?php echo url_for('customer/new') ?>">Neuer Kunde</a>
	</td></tr>
    <tr>
      <th>Firmenname</th>
      <th>Strasse</th>
      <th>PLZ</th>
	  <th>Ort</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $customer): ?>
    <tr class="table_item"	onclick="document.location = '<?php echo url_for('customer/show?id='.$customer->getId()) ?>'">

      <td><?php echo $customer->getCompany() ?> </td>
      <td><?php echo $customer->getStore()->getStreet() ?></td>
	  <td><?php echo $customer->getStore()->getPostcode() ?></td>
	<td><?php echo $customer->getStore()->getCity().
				 ' '.$customer->getStore()->getDestrict(); ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php if ($pager->haveToPaginate()): ?>
<ul class="pageing">
<li ><?php echo	link_to('<<' ,'customer/index/?page='.$pager->getFirstPage(),'class=button'); ?></li>	
<li ><?php echo	link_to( '<','customer/index/?page='.$pager->getPreviousPage(),'class=button'); ?></li>

<?php foreach ($pager->getLinks() as $page): ?>
      <?php if ($page == $pager->getPage()): ?>
       <li  class="button" >  <?php echo $page ?> </li >
      <?php else: ?>
       <li ><?php echo	link_to($page ,'customer/index/?page='.$page,'class=button'); ?></li>
      <?php endif; ?>
<?php endforeach; ?>
<li ><?php echo	link_to('>' ,'customer/index/?page='.$pager->getNextPage(),'class=button'); ?></li>
<li ><?php echo	link_to('>>' ,'customer/index/?page='.$pager->getLastPage(),'class=button'); ?></li>
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
