<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('entry/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>


		<tr>
			<th>Suche</th>
			<td > <?php echo $form['item_id']?></td>
			<td rowspan="2"><?php echo $form['amount']->render(array('size' => 2,)) ?></td>
			<td rowspan="2"> <?php echo $form->renderHiddenFields() ?><input type="image"  src="/images/icons/add.png" /></td>
		</tr>
			<th>Freitext</th>
				
		 	<td ><?php echo $form['description'] ?></td>
		<tr>
		</tr>	
		<tr>
	        <td colspan="2">
	       		<a class="button" href="<?php echo url_for('job/show?id='.$job->getId()) ?>">
					 zurück</a>
	          <?php if (!$form->getObject()->isNew()): ?>
	            &nbsp;<?php echo link_to('Delete', 'entry/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>

	          <?php endif; ?>
	        </td>
	      </tr>

		 
</form>
