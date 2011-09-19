<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<form action="<?php echo url_for('job/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a class="button" href="<?php echo url_for('job/index') ?>">zurück</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Löschen', 'job/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?', 'class'=> 'button')) ?>
	
          <?php endif; ?>
          <input type="submit" class="button" value="Speichern" />
        </td>
      </tr>
    </tfoot>
	  <tbody>
	<?php if (!$form->getObject()->isNew()): ?>	
	    <tr>
	<th>Auftragsnummer</th>
	      <td>
	      
	<h1 id=""><?php echo $form['id']->getValue() ?></h1>	
	
	 </td>
		</tr>
	<?php endif; ?></td>	
	   <tr>
		<?php if (isset($form['timeinterval'])): ?>
				<th>Wiederholung ? </th>
				<td><?php echo $form['timeinterval']->renderError()  ?><?php echo $form['timeinterval']->render()  ?></td>
		<?php endif ?>
		<?php if (isset($form['job_state_id'])): ?>
		<th><?echo $form['job_state_id']->renderLabel() ?></th>
		<td><?php echo $form['job_state_id']->render() ?></td>
		</tr>
		<tr>
		<?php endif ?>
			<?php if (isset($form['start'])): ?>
				<th><?echo $form['start']->renderLabel() ?></th>
				<td>
				<?php echo $form['start']->render() ?>
				</td>
				
			<?php endif ?>
	      <th><?echo $form['end']->renderLabel() ?></th>
	      <td><?php echo $form['end']->render() ?></td>
	    </tr>
	   
		<tr>
	      <th><?echo $form['contact_person']->renderLabel() ?></th>
	      <td><?php echo $form['contact_person']->render(array('size' => 50,)) ?></td>
	      <th><?echo $form['contact_info']->renderLabel() ?></th>
	      <td><?php echo $form['contact_info']->render(array('size' => 50,)) ?></td>
	    </tr>
	    <tr>
	      <th><?echo $form['store_id']->renderLabel() ?></th>
	      <td colspan="3"><?php echo $form['store_id']->render(array('size' => 100,)) ?></td>
	    </tr>
			 <tr>
			      <th><?echo $form['description']->renderLabel() ?></th>
			      <td colspan="3"><?php echo $form['description']->render(array('rows' => 5,'cols' => 80,)) ?></td>
			 </tr>
	
	   
		<?php echo $form->renderHiddenFields() ?>
	  </tbody>
	</table>
</form>



