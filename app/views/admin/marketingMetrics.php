<?php
// TODO: generalize this, so should additional metrics need to be collected, we don't have to program them
?>

<table width="100%" border="1" cellpadding="1" cellspacing="0">
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
<?php foreach ($data as $row): ?>
 <tr>
  <td><?=$row->account_id?></td>
  <td><?=$row->cookie_id?></td>
  <td><?=$row->username?></td>
  <td><?=$row->created_at?></td>
  <td><?=$row->referring_url?></td>
  <td><?=$row->landing_page?></td>
  <td><?=$row->activity?></td>
  <td><?=$row->registration_date?></td>
 </tr>
<?php endforeach; ?>
</table>

<p><?=anchor('/admin', 'Menu')?></p>

