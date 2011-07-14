<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form);
$calendar = $sf_user->getAttribute('calendar') ?>

<form action="<?php echo url_for('calendar/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="3" >
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a  class="button" href="<?php echo url_for('calendar/index/?period='.$calendar['period'].'&next='.($calendar['next']).'&user='.$calendar['user']) ?>">zurück</a>
 
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Löschen', 'calendar/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Sind sie sicher das den Termin Löschen wollen?','class' => 'button')) ?>
          <?php endif; ?>
          <input  class="button" type="submit" value="Speichern" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>

	 <th><?php echo $form['job_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['job_id']->renderError() ?>
          <?php echo $form['job_id'] ?> 
		<?php if (isset($job)): ?>
			
		<strong>	<?php echo $job->getId() ?></strong>
			 <td>
			<?php echo $job->getStore()->getCustomer()->getCompany() ?>
			
			 </td>
			 <td>
			<?php echo $job->getStore()->getStreet() ?>
			<br>
			<?php echo $job->getStore()->getPostcode() ?>
			
			<?php echo $job->getStore()->getCity() ?>
			 </td>
		<?php endif ?>	
        </td>
      </tr>

<tr>
        <th><?php echo $form['beginn']->renderLabel() ?></th>
        <td colspan="2" >
          <?php echo $form['beginn']->renderError() ?>
          <?php echo $form['beginn'] ?>
        </td>
      
        <th><?php echo $form['duration']->renderLabel() ?></th>
        <td>
          <?php echo $form['duration']->renderError() ?>
          <?php echo $form['duration']->render(array('size' => 1,)) ?> Stunden
        </td>
      </tr>
      <?php if (isset($form['type_id'])): ?>
      <tr>
        <th><?php echo $form['type_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['type_id']->renderError() ?>
          <?php echo $form['type_id'] ?>
        </td>
      </tr>
      <?php endif ?>	
      <tr>
        <th><?php echo $form['users_list']->renderLabel() ?></th>
        <td colspan="4" >
          <?php echo $form['users_list']->renderError() ?>
          <?php echo $form['users_list'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
