
Neue Datensätze <?php echo $count ?><br>
<table border="0" cellspacing="5" cellpadding="5">
<?php foreach ($return as $data ): ?>
	
	<?php echo htmlspecialchars_decode($data); ?>

<?php endforeach ?>
</table>