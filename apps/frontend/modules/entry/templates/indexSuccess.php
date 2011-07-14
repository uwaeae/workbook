<h1>Entrys List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Description</th>
      <th>Amount</th>
      <th>Item</th>
      <th>Job</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($entrys as $entry): ?>
    <tr>
      <td><a href="<?php echo url_for('entry/show?id='.$entry->getId()) ?>"><?php echo $entry->getId() ?></a></td>
      <td><?php echo $entry->getDescription() ?></td>
      <td><?php echo $entry->getAmount() ?></td>
      <td><?php echo $entry->getItemId() ?></td>
      <td><?php echo $entry->getJobId() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('entry/new') ?>">New</a>
