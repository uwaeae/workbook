<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $entry->getId() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $entry->getDescription() ?></td>
    </tr>
    <tr>
      <th>Amount:</th>
      <td><?php echo $entry->getAmount() ?></td>
    </tr>
    <tr>
      <th>Item:</th>
      <td><?php echo $entry->getItemId() ?></td>
    </tr>
    <tr>
      <th>Job:</th>
      <td><?php echo $entry->getJobId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('entry/edit?id='.$entry->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('entry/index') ?>">List</a>
