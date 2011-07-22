<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<h1>Thermine</h1>

<?php
$rows = 0;
$cols = count($calendar);
$table = "";
echo "<table border=\"0\" cellspacing=\"5\" cellpadding=\"5\"><thead><tr>";
foreach ($calendar as $entry ) {
		if($rows < count($entry['jobs']))$rows = count($entry['jobs']);
		echo "<th colspan=\"3\">".$entry['w']."</th>";
}
echo "</tr><tr>";
foreach ($calendar as $entry ) {
		//$table = $table."<td>Uhrzeit</td> <td> ID</td> <td>  Firma </td><td> Eingeteilt </td> ";
}

echo "</thead><tbody>";

for ($i=0; $i < $rows; $i++) { 
	echo "<tr>";
	for ($j=0; $j < $cols; $j++) { 
		if( $calendar[$j]['jobs'][$i]->getId()) {
		$job = $calendar[$j]['jobs'][$i];
		$users = " ";
		foreach ($job->getUsers() as $user){
			 $users = $users. $user->getName().'<br/>';}
		echo '<td><a href="'.url_for('job/edit?id='.$job->getId()).'"><strong>'.$job->getId().'</strong>'.
		'<br>'.date('H:i',strtotime($job->getTimeed())).
		'</a></td><td>'.$job->getStore()->getCustomer()->getCompany() .
		'<br>'.$job->getStore()->getStreet().
		'<br>'.$job->getStore()->getPostcode().' '.$job->getStore()->getCity().
		'</td><td>'.$users.'</td>';
		}
		else echo '<td> </td>';
	
	}
	echo "</tr>";
}
?>

<form action="<?php echo url_for('job/thermin') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <table id="job_form">
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="image" class="smallicon" src="/images/icons2/checkmark.png" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>