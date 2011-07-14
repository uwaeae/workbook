<h1>Users List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Login</th>
      <th>Password</th>
      <th>Lastname</th>
      <th>Firstname</th>
      <th>Street</th>
      <th>Postcode</th>
      <th>City</th>
      <th>Role</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
    <tr>
      <td><a href="<?php echo url_for('user/show?id='.$user->getId()) ?>"><?php echo $user->getId() ?></a></td>
      <td><?php echo $user->getLogin() ?></td>
      <td><?php echo $user->getPassword() ?></td>
      <td><?php echo $user->getLastname() ?></td>
      <td><?php echo $user->getFirstname() ?></td>
      <td><?php echo $user->getStreet() ?></td>
      <td><?php echo $user->getPostcode() ?></td>
      <td><?php echo $user->getCity() ?></td>
      <td><?php echo $user->getRoleId() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('user/new') ?>">New</a>
