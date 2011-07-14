<table>
  <thead>
    <tr>
      <th style="width:150px;">Start</th>
      <th style="width:150px;">Ende</th>
      <th style="width:350px;">Arbeiten</th>
      <th style="width:150px;">Erstellt</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($job->getTasks() as $task): ?>
    <tr>
      <td><?php echo $task->getStart() ?></td>
      <td><?php echo $task->getEnd() ?></td>
      <td><?php echo $task->getInfo() ?></td>
      <td><?php echo $task->getCreatedAt() ?></td>
<td>	<a href="<?php echo url_for('task/edit/?id='.$task->getId()) ?>"><img src="/images/icons/page_edit.png" /></a></td>
    </tr>
    <?php endforeach; ?>
  </tbody>

</table>