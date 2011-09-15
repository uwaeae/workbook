 <table class="showtable">
      <tr>
        <th>Beginn</th>
        <td>
          <?php echo $task->getStart() ?>
        </td>

		 <th>30 %</th>
	        <td>
	          <?php echo $task->getOvertime()  ?> Stunden
	        </td>

      </tr>
      <tr>
        <th>Ende</th>
        <td>
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
          <?php echo $task->getApproach() ?> Minuten
        </td>

        <th>Pause</th>
        <td>
          <?php echo $task->getBreak() ?> Minuten
        </td>

      </tr>
      <tr>
        <th>Info</th>
        <td colspan="3">
          <?php echo $task->getInfo() ?>
         </td>
      </tr>

      <tr>
        <th>Auftrag</th>
        <td>
          <?php echo $task->getJob()?>
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

