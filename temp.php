<table>
  <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th>Matchcode</th>
        <th>Bezeichung</th>
        <th>Beschreibung</th>    
      </tr>

<?php foreach ($form['newItems'] as $item): ?>
	<tr>
		<td>
        <?php echo $item['code']->renderError() ?>
        <?php echo $item['code'] ?>  
       	</td>
		<td>
        <?php echo $item['name']->renderError() ?>
        <?php echo $item['name'] ?>
        </td>
		<td>
        <?php echo $item['description']->renderError() ?>
        <?php echo $item['description'] ?>
        </td>
	</tr>
<?php endforeach ?>
    </tbody>
  </table>
