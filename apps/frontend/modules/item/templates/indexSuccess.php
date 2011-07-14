<h1>Items List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Code</th>
      <th>Name</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($items as $item): ?>
    <tr>
      <td><a href="<?php echo url_for('item/show?id='.$item->getId()) ?>"><?php echo $item->getId() ?></a></td>
      <td><?php echo $item->getCode() ?></td>
      <td><?php echo $item->getName() ?></td>
      <td><?php echo $item->getDescription() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('item/new') ?>">New</a>
