
<div id="<?php echo $type ?>">
<h1 class="<?php echo $type ?>_head">(<?php echo count($jobs)  ?>) <?php echo $info ?></h1>

<div class="<?php echo $type ?>_body">
	

<ul >
	
	<?php foreach ($jobs as $job): ?>
	
	
	<li class="<?php echo $type ?>_item" 	onclick="document.location = '<?php  echo url_for('job/show?id='.$job->getId()) ?>'">

  <table>
      <tr>

          <td colspan="3"> <strong><?php echo $job->getId()?></strong>
          </td>

      </tr>

      <tr>
          <td>
              Ende:
          </td>
          <td colspan="2">
              <?php echo format_date($job->getEnd(),'dd.MM.') ?>

          </td>
      </tr>
      <tr>
          <td>
              Anfang:
          </td>
          <td colspan="2">
              <?php echo format_date($job->getStart(),'dd.MM.') ?>
          </td>
      </tr>



      <TR>
          <td rowspan="3"> Kunde</td>
          <td colspan="2">
              <?php echo $job->getStore()->getCustomer()->getCompany() ?>

          </td>
      </TR>

      <tr>
          <td colspan="2">
              <?php echo $job->getStore()->getStreet() ?>
          </td>
      </tr>

      <tr>
          <td colspan="2">
              <?php echo sprintf("%1$05d", $job->getStore()->getPostcode()) ?> <?php echo $job->getStore()->getCity() ?>
          </td>
      </tr>
      <tr>
          <td colspan="3">
              <?php echo substr($job->getDescription(), 0, 50) ?>
          </td>
      </tr>
  </table>

		
    </li>

    <?php endforeach; ?>
<ul>
</div>
</div>