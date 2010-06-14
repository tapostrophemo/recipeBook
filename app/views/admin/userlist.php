<h3>Userlist</h3>

<table>
 <tr><th>Username</th><th>Email</th></tr>
<?php foreach ($users as $user): ?>
 <tr>
  <td><?=$user->username?></td>
  <td><?=$user->email?></td>
 </tr>
<?php endforeach; ?>
</table>

<p><?=anchor('admin/adduser', 'Add User?', array('id' => 'addUserControl'))?></p>

