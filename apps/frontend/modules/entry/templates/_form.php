<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('entry/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>


		<tr>
			<th>Suche</th>
			<td ><?php echo $form['description'] ?>

				<script type="application/javascript">

					$(document).ready(function(){

						$("#entry_description").autocomplete({
							source: function (request, response) {
								var url = "<?php echo url_for('entry/ajax') ?>";


								$.ajax({
									url: url + "?q=" + request.term,
									dataType: "json",

									success: function (data) {
										response($.map(data, function (item) {
											//debugger;
											return {
												label:  item.name ,
												data: item
											}
										}));
									}
								});
							},
							minLength: 2,
							select: function (event, ui) {

								$('input#entry_code').val(ui.item.data.code);
								$('input#entry_unit').val(ui.item.data.unit);
								$('input#entry_name').val(ui.item.data.name);





							}

						});


					});

				</script>
			</td>
			<td rowspan="2"><?php echo $form['amount']->render(array('size' => 2,)) ?></td>
			<td rowspan="2"> <?php echo $form->renderHiddenFields() ?><input type="image"  src="/images/icons/add.png" /></td>

		</tr>	
		<tr>
	        <td colspan="2">
	       	
	          <?php if (!$form->getObject()->isNew()): ?>
	            &nbsp;<?php echo link_to('Delete', 'entry/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>

	          <?php endif; ?>
	        </td>
	      </tr>

		 
</form>
