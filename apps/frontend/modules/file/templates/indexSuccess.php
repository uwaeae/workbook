<h1>Files List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>File</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($files as $file): ?>
    <tr>
      <td><a href="<?php echo url_for('file/edit?id='.$file->getId()) ?>"><?php echo $file->getId() ?></a></td>
      <td><?php echo $file->getName() ?></td>
      <td><?php echo $file->getFile() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('file/new') ?>">New</a>
