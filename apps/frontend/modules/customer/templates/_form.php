<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('customer/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php if (!$form->getObject()->isNew()): ?>
			<a class="button" href="<?php echo url_for('customer/show?id='.$form->getObject()->getId()) ?>">zurück</a>
            &nbsp;<?php echo link_to('Löschen', 'customer/delete?id='.$form->getObject()->getId(), array('class'=>'button','method' => 'delete', 'confirm' => 'Sind sie sicher das sie diesen Kunden löschen wollen?')) ?>
          <?php endif; ?>
          <input class="button" type="submit" value="Speichern" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
