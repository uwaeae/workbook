<h1>Stores List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Number</th>
      <th>Street</th>
      <th>Housenumber</th>
      <th>Postcode</th>
      <th>Customer</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($stores as $store): ?>
    <tr>
      <td><a href="<?php echo url_for('store/show?id='.$store->getId()) ?>"><?php echo $store->getId() ?></a></td>
      <td><?php echo $store->getName() ?></td>
      <td><?php echo $store->getNumber() ?></td>
      <td><?php echo $store->getStreet() ?></td>
      <td><?php echo $store->getHousenumber() ?></td>
      <td><?php echo $store->getPostcode() ?></td>
      <td><?php echo $store->getCustomerId() ?></td>
      <td><?php echo $store->getCreatedAt() ?></td>
      <td><?php echo $store->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('store/new') ?>">New</a>
