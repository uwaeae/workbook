<h1>Benutzer Liste</h1>

<table class="job">
  <thead>
    <tr>
      <th>ID</th>
      <th>Vorname</th>
      <th>Nachname</th>
		<th>E-Mail Adresse</th>
			<th>Username</th>
		<th>Letzer Login</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($sf_guard_users as $sf_guard_user): ?>
    <tr class="table_item">
      <td><?php echo $sf_guard_user->getId() ?></a></td>
      <td><?php echo $sf_guard_user->getFirstName() ?></td>
      <td><?php echo $sf_guard_user->getLastName() ?></td>
      <td><?php echo $sf_guard_user->getEmailAddress() ?></td>
      <td><?php echo $sf_guard_user->getUsername() ?></td>
      <td><?php echo $sf_guard_user->getLastLogin() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

