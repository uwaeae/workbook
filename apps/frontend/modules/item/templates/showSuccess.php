<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $item->getId() ?></td>
    </tr>
    <tr>
      <th>Code:</th>
      <td><?php echo $item->getCode() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $item->getName() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $item->getDescription() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('item/edit?id='.$item->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('item/index') ?>">List</a>
