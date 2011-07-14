<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $store->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $store->getName() ?></td>
    </tr>
    <tr>
      <th>Number:</th>
      <td><?php echo $store->getNumber() ?></td>
    </tr>
    <tr>
      <th>Street:</th>
      <td><?php echo $store->getStreet() ?></td>
    </tr>
    <tr>
      <th>Housenumber:</th>
      <td><?php echo $store->getHousenumber() ?></td>
    </tr>
    <tr>
      <th>Postcode:</th>
      <td><?php echo $store->getPostcode() ?></td>
    </tr>
    <tr>
      <th>Customer:</th>
      <td><?php echo $store->getCustomerId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $store->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $store->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('store/edit?id='.$store->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('store/index') ?>">List</a>
