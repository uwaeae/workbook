<h1>Roles List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Parent</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($roles as $role): ?>
    <tr>
      <td><a href="<?php echo url_for('role/show?id='.$role->getId()) ?>"><?php echo $role->getId() ?></a></td>
      <td><?php echo $role->getName() ?></td>
      <td><?php echo $role->getParent() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('role/new') ?>">New</a>
