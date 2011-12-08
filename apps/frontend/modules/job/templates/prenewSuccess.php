<?php use_javascript('/sfFormExtraPlugin/js/jquery.autocompleter.js') ?>
<?php use_stylesheet('/sfFormExtraPlugin/css/jquery.autocompleter.css') ?>

<h1>Neuer Auftrag</h1>

<form action="<?php echo url_for('job/new') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
  <table id="job_form">
    <tfoot>
      <tr>
		 <td colspan="1">
	          <?php echo link_to('Neuer Kunde','customer/new',array('class'=>'button')); ?>
	        </td>
        <td colspan="1">
          <input type="submit" class="button" value="weiter" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
