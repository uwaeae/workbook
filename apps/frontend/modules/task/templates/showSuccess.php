<h3 class="job_work">Arbeit 
</h3> 

<table class="job_component">
      <tr>
        <th>Beginn</th>
        <td colspan="3">
          <?php echo $task->getStart() ?>
        </td>

		 <th>30 %</th>
	        <td>
	          <?php echo $task->getOvertime()  ?> Stunden
	        </td>

      </tr>
      <tr>
        <th>Ende</th>
        <td colspan="5">
          <?php echo $task->getEnd() ?>
        </td>
      </tr>
	 <tr>
		
	    <th>Type</th>
	        <td>
	          <?php echo $task->getTaskType() ?>
	        </td>
		
	    <th>Anfahrt</th>
        <td>
          <?php echo $task->getApproach()*15 ?> Minuten
        </td>

        <th>Pause</th>
        <td>
          <?php echo $task->getBreak()*15 ?> Minuten
        </td>

      </tr>
      <tr>
        <th>Info</th>
        <td colspan="5">
          <?php echo $task->getInfo() ?>
         </td>
      </tr>

      <tr>
        <th>Adresse</th>
        <td>
			<?php echo $task->getJob()->getStore()->getCustomer()->getCompany() ?><br>
			<?php echo $task->getJob()->getStore()->getStreet() ?><br>
			<?php echo sprintf("%1$05d", $task->getJob()->getStore()->getPostcode())?>
			<?php echo $task->getJob()->getStore()->getCity() ?>
			<?php echo $task->getJob()->getStore()->getDestrict() ?>
        </td>
      </tr> 


      <tr>
        <th>Mitarbeiter</th>
        <td>
		<?php foreach ($task->getUsers() as $user): ?>
			<?php echo $user; ?>
		<?php endforeach ?>
          
        </td>
      </tr>

    </tbody>
  </table>
<h3 class="job_work">Material 

	</h3>
<table class="job_component" style="width: 100%">
  <thead>
    <tr>
		<th  >Menge</th>
      <th  >Einheit</th>
      <th >Artikel</th>
      <th >Beschreibung</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($task->getEntry() as $entry): ?>
    <tr>
		<td colspan="2" style="width:10%;"><?php echo $entry->getAmount() ?> </td>
		<td><?php echo $entry->getUnit()  ?></td>
		<td><?php echo $entry->getCode() ?></td>
		<td><?php echo $entry->getDescription(); ?></td>

    </tr>
    <?php endforeach; ?>
  </tbody>

</table>
<?php echo link_to('zurück',$back,array('class'=>'button')) ?>


