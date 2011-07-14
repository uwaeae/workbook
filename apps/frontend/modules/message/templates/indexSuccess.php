<h1>Messages List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Parent</th>
      <th>Sender</th>
      <th>Reciver</th>
      <th>Job</th>
      <th>Body</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($messages as $message): ?>
    <tr>
      <td><a href="<?php echo url_for('message/edit?id='.$message->getId()) ?>"><?php echo $message->getId() ?></a></td>
      <td><?php echo $message->getParent() ?></td>
      <td><?php echo $message->getSender() ?></td>
      <td><?php echo $message->getReciver() ?></td>
      <td><?php echo $message->getJobId() ?></td>
      <td><?php echo $message->getBody() ?></td>
      <td><?php echo $message->getCreatedAt() ?></td>
      <td><?php echo $message->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('message/new') ?>">New</a>
