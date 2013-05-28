

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
		     <a class="button" href="<?php echo url_for('job') ?>">zurück</a>
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
	        <th><?php echo $form['number']->renderLabel() ?></th>
	        <td>
	          <?php echo $form['number']->renderError() ?>
	          <?php echo $form['number'] ?>
	        </td>
	      </tr>

    </tbody>
  </table>
</form>
