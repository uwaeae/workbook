<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php if (isset($customer)): ?>
	<h1 id=""><?php echo $customer->getNumber() ?> - <?php echo $customer->getCompany() ?></h1>
<?php endif ?>


<form action="<?php echo url_for('store/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a class="button" href="<?php echo url_for('customer/index') ?>">Abrechen</a>
          <input class="button" type="submit" value="Speichern" />
        </td>
      </tr>
    </tfoot>
		<tbody>
			<?php if (!$form['number']->isHidden()): ?>
			<tr>
				<th><?php echo $form['number']->renderLabel() ?></th>
				<td>
					<?php echo $form['number']->renderError() ?>
					<?php echo $form['number']->render() ?>
				</td>
			</tr>
			<?php endif ?>
			<tr>
				<th><?php echo $form['contact']->renderLabel() ?></th>
				<td colspan="5">
					<?php echo $form['contact']->renderError() ?>
					<?php echo $form['contact']->render(array('size' => 100,)) ?>
				</td>
			</tr>
			<tr>
				<th><?php echo $form['info']->renderLabel() ?></th>
				<td colspan="3">
					<?php echo $form['info']->renderError() ?>
					<?php echo $form['info']->render() ?>
				</td>
			</tr>
			<tr>
				<th><?php echo $form['fon']->renderLabel() ?></th>
				<td>
					<?php echo $form['fon']->renderError() ?>
					<?php echo $form['fon']->render() ?>
				</td>
				<th><?php echo $form['fax']->renderLabel() ?></th>
				<td>
					<?php echo $form['fax']->renderError() ?>
					<?php echo $form['fax']->render() ?>
				</td>
			</tr>
			<tr>
				<th><?php echo $form['street']->renderLabel() ?></th>
				<td colspan="5">
					<?php echo $form['street']->renderError() ?>
					<?php echo $form['street']->render(array('size' => 100,)) ?>
				</td>
			</tr>
			<tr>
				<th><?php echo $form['postcode']->renderLabel() ?></th>
				<td>
					<?php echo $form['postcode']->renderError() ?>
					<?php echo $form['postcode']->render(array('size' => 6,)) ?>
				</td>
				<th><?php echo $form['city']->renderLabel() ?></th>
				<td>
					<?php echo $form['city']->renderError() ?>
					<?php echo $form['city']->render() ?>
				</td>
				<th><?php echo $form['destrict']->renderLabel() ?></th>
				<td>
					<?php echo $form['destrict']->renderError() ?>
					<?php echo $form['destrict']->render() ?>
				</td>
			</tr>
			<?php if (!$form['customer_id']->isHidden()): ?>
			<tr>
				<th><?php echo $form['customer_id']->renderLabel() ?></th>
				<td>
					<?php echo $form['customer_id']->renderError() ?>
					<?php echo $form['customer_id']->render() ?>
				</td>
			</tr>
			<?php endif ?>
			<tr>
				<td>	<?php echo $form->renderHiddenFields() ?></td>
			</tr>
	  </tbody>
  </table>
</form>