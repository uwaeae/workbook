<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('task/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>	
      <tr>

        <td colspan="2">
        	<a class="button" href="<?php echo url_for($back)  ?>">zurück </a>
		    <?php if (!$form->getObject()->isNew()): ?>
		    <?php echo link_to('Löschen', 'task/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Sind sie sicher?','class' => 'button')) ?>
		    <?php endif; ?>
		    <input type="submit" class="button" value="Speichern" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['start']->renderLabel() ?></th>
        <td class="task_start">
          <?php echo $form['start']->renderError() ?>
          <?php echo $form['start'] ?>
        </td>
<?php if (!$form['overtime']->isHidden()): ?>	
		 <th><?php echo $form['overtime']->renderLabel() ?></th>
	        <td>
	          <?php echo $form['overtime']->renderError() ?>
	          <?php echo $form['overtime']  ?> Stunden
	        </td>
	<?php endif ?>
      </tr>
      <tr>
        <th><?php echo $form['end']->renderLabel() ?></th>
        <td class="task_end">
          <?php echo $form['end']->renderError() ?>
          <?php echo $form['end'] ?>
        </td>
      </tr>
	 <tr>
		
		
			<?php if (!$form['task_type_id']->isHidden()): ?>
	        <th><?php echo $form['task_type_id']->renderLabel() ?></th>
	        <td>
	          <?php echo $form['task_type_id']->renderError() ?>
	          <?php echo $form['task_type_id'] ?>
	        </td>
	<?php endif ?>
		
		<?php if (!$form['approach']->isHidden()): ?>
        <th><?php echo $form['approach']->renderLabel() ?></th>
        <td>
          <?php echo $form['approach']->renderError() ?>
          <?php echo $form['approach'] ?> Minuten
        </td>
<?php endif ?>
<?php if (!$form['break']->isHidden()): ?>	

        <th><?php echo $form['break']->renderLabel() ?></th>
        <td>
          <?php echo $form['break']->renderError() ?>
          <?php echo $form['break'] ?> Minuten
        </td>
<?php endif ?>
      </tr>
<?php if (!$form['info']->isHidden()): ?>
      <tr>
        <th><?php echo $form['info']->renderLabel() ?></th>
        <td colspan="3">
          <?php echo $form['info']->renderError() ?>
          <?php echo $form['info']->render(array('rows' => 10,'cols' => 80,)) ?>
        </td>
      </tr>
<?php endif ?>
 <?php if (!$form['job_id']->isHidden()): ?>	
      <tr>
        <th><?php echo $form['job_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['job_id']->renderError() ?>
          <?php echo $form['job_id'] ?>
        </td>
      </tr> 
<?php endif ?>
 <?php if (!$form['users_list']->isHidden()): ?>
      <tr>
        <th rowspan="2"><?php echo $form['users_list']->renderLabel() ?></th>
        <td rowspan="2">
          <?php echo $form['users_list']->renderError() ?>
          <?php echo $form['users_list']->render(array('style' => 'height: 250px'))  ?>
        </td>
      
<?php endif ?> 
<?php if (isset($form['correction_time']) and !$form['correction_time']->isHidden()): ?>
      
        <th><?php echo $form['correction_time']->renderLabel() ?></th>
        <td>
          <?php echo $form['correction_time']->renderError() ?>
          <?php echo $form['correction_time'] ?> Stunden
	</tr>
	<tr>
		<th><?php echo $form['correction_info']->renderLabel() ?></th>
        <td>
          <?php echo $form['correction_info']->renderError() ?>
          <?php echo $form['correction_info'] ?>
        </td>
      </tr>
<?php endif ?>
 </tr>
    </tbody>
  </table>


	  <?php echo $form->renderHiddenFields() ?>
    



</form>
