<?php use_javascript('jquery-1.4.4.min.js') ?>
<?php use_javascript('import.js') ?>
<h1 id="zuordnung">  Import von  
 	<?php 
	switch($typ){
		case 0: 
			echo 'Kunden';
			break;
		case 1: 
			echo 'Filialen';
			break;
		case 2: 
			echo 'Mitarbeiter';
			break;	
		case 3: 
			echo 'Artikel';
			break;	
	 }
	?> - Zuordnung</h1> 
<div id="loader">
	 <?php echo image_tag('ajax-loader.gif') ?>
	
</div>
<div id="results">
	 	
</div>
<div id="order">
<?php echo $form->renderFormTag('import',array('id'=> 'inputForm')) ?>
  <table>
    <?php echo $form ?>
    <tr>
      <td colspan="2">
        <input id="submit" type="submit" />
      </td>
    </tr>
  </table>
</form>
</div>	
