<table class="report">
 <tr>
  <th>Plan</th>
  <th>Plan ID</th>
  <th>Username</th>
  <th>User ID</th>
  <th>Registered on</th>
  <th>Last logged in</th>
  <th># Recipes</th>
  <th># Friends</th>
 </tr>
<?php $i = 0; foreach ($data as $row): ?>
 <tr<?= $i % 2 ? ' class="alt"' : '';?>>
  <td><?=$row->plan?></td>
  <td><?=$row->plan_id?></td>
  <td><?=$row->username?></td>
  <td><?=$row->account_id?></td>
  <td><?=$row->created_at?></td>
  <td><?=$row->last_login_at?></td>
  <td><?=$row->num_recipes?></td>
  <td><?=$row->num_editors?></td>
 </tr>
<?php $i++; endforeach; ?>
</table>

<p><?=anchor('/admin', 'Menu')?></p>

