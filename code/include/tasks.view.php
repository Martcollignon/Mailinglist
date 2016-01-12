<table>
  <thead>
    <tr>
      <th class="shrink"></th>
      <th class="expand">Content</th>
      <th class="shrink">Deadline</th>
      <th class="shrink">Action</th>
    </tr>
  </thead>

  <tbody>
  <?php foreach($tasks as $task): ?>
    <tr>
      <td class="shrink">
        <input type="checkbox"
          name="tasks[]"
          value="<?php echo $task['id']; ?>"
          <?php if(!empty($task['done'])) echo 'checked="checked"'; ?> />
      </td>
      <td><?php echo $task['content']; ?></td>
      <td class="shrink">
      <?php if($task['deadline'] != '0000-00-00 00:00:00') echo $task['deadline']; ?>
      </td>
      <td class="shrink">
        <a class="action" href="task.php?id=<?php echo $task['id']; ?>"><i class="fa fa-pencil"></i></a>
        <a class="action" href="delete-task.php?id=<?php echo $task['id']; ?>"><i class="fa fa-trash-o"></i></a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
