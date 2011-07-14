<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $user->getId() ?></td>
    </tr>
    <tr>
      <th>Login:</th>
      <td><?php echo $user->getLogin() ?></td>
    </tr>
    <tr>
      <th>Password:</th>
      <td><?php echo $user->getPassword() ?></td>
    </tr>
    <tr>
      <th>Lastname:</th>
      <td><?php echo $user->getLastname() ?></td>
    </tr>
    <tr>
      <th>Firstname:</th>
      <td><?php echo $user->getFirstname() ?></td>
    </tr>
    <tr>
      <th>Street:</th>
      <td><?php echo $user->getStreet() ?></td>
    </tr>
    <tr>
      <th>Postcode:</th>
      <td><?php echo $user->getPostcode() ?></td>
    </tr>
    <tr>
      <th>City:</th>
      <td><?php echo $user->getCity() ?></td>
    </tr>
    <tr>
      <th>Role:</th>
      <td><?php echo $user->getRoleId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('user/edit?id='.$user->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('user/index') ?>">List</a>
