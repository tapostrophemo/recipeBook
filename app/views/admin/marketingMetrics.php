<?php
// TODO: generalize this, so should additional metrics need to be collected, we don't have to program them
?>

<table class="report">
 <tr>
  <th>Account #</th>
  <th>Cookie</th>
  <th>Username</th>
  <th>First visit</th>
  <th>Referrer</th>
  <th>Landing page</th>
  <th>Last activity</th>
  <th>Registration date</th>
 </tr>
<?php $i = 0; foreach ($data as $row): ?>
 <tr<?= $i % 2 ? ' class="alt"' : '';?>>
  <td><?=$row->account_id?></td>
  <td><?=$row->cookie_id?></td>
  <td><?=$row->username?></td>
  <td><?=$row->created_at?></td>
  <td><?=$row->referring_url?></td>
  <td><?=$row->landing_page?></td>
  <td><?=$row->activity?></td>
  <td><?=$row->registration_date?></td>
 </tr>
<?php $i++; endforeach; ?>
</table>

<p><?=anchor('/admin', 'Menu')?></p>

