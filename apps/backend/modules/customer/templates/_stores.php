<?php //echo link_to('Filalen Bearbeiten', 'store') ?> 

<div class="list">
	
Filialen
<ul>
<?php foreach($customer->getStores() as $store): ?>
	<li><?php echo link_to('<strong>'.$store->getNumber().'</strong> '.$store->getStreet(), 'store/edit/?id='.$store->getID()) ?> </li>
<?php endforeach?>
</ul>
</div>