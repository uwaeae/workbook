<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $task->getId() ?></td>
    </tr>
    <tr>
      <th>Number:</th>
      <td><?php echo $task->getNumber() ?></td>
    </tr>
    <tr>
      <th>Start:</th>
      <td><?php echo $task->getStart() ?></td>
    </tr>
    <tr>
      <th>End:</th>
      <td><?php echo $task->getEnd() ?></td>
    </tr>
    <tr>
      <th>Break:</th>
      <td><?php echo $task->getBreak() ?></td>
    </tr>
    <tr>
      <th>Approach:</th>
      <td><?php echo $task->getApproach() ?></td>
    </tr>
    <tr>
      <th>Job:</th>
      <td><?php echo $task->getJobId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $task->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $task->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('task/edit?id='.$task->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('task/index') ?>">List</a>
