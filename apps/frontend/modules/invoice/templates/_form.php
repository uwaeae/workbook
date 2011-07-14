<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php  use_helper('Date');?>

<form action="<?php echo url_for('invoice/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;
		<a class="button" href="<?php echo url_for('job/archiv/') ?>">zurück</a>
          <?php if (!$form->getObject()->isNew()): ?>
			
            &nbsp;<?php echo link_to('Löschen', 'invoice/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?','class' => 'button')) ?>
          <?php endif; ?>
          <input class="button" type="submit" value="Speichern" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      
      
      <tr>
        <th><?php echo $form['jobs_list']->renderLabel() ?></th>
        <td>
          <?php echo $form['jobs_list']->renderError() ?>
          <?php echo $form['jobs_list'] ?>
			<?php if (isset($job)): ?>

				<?php foreach ($job->getCalendar() as $thermin): ?>
					<?php echo  format_date($thermin->getBeginn(),'dd.MM.yyyy HH:mm') ?><br>
				<?php endforeach ?>
			
				<?php echo $job->getStore()->getCustomer()->getCompany() ?>
				<br>
				
				<?php echo $job->getStore()->getStreet() ?>
				<br>
				<?php echo $job->getStore()->getPostcode() ?>

				<?php echo $job->getStore()->getCity() ?>
					<br>
				<?php echo $job->getDescription() ?>
			<?php endif ?>
        </td>
		<tr>
	        <th><?php echo $form['number']->renderLabel() ?></th>
	        <td>
	          <?php echo $form['number']->renderError() ?>
	          <?php echo $form['number'] ?>
	        </td>
	      </tr>
      </tr>
    </tbody>
  </table>
</form>
