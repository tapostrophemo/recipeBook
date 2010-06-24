<?php
$total = 0;
?>

<h3>Friends</h3>
<p>Invite others to edit your cookbook.</p>

<table>
 <tr><td></td><th style="text-align:left">Name</th></tr>
<?php foreach ($friends as $friend): ?>
 <tr>
  <td><?=++$total?></td>
  <td><?=$friend->name?></td>
 </tr>
<?php endforeach; ?>
<?php while (++$total <= $max): ?>
 <tr>
  <td><?=$total?></td>
  <td>_________</td>
 </tr>
<?php endwhile; ?>
</table>

<p><?=anchor('friends/add', 'Invite friend?', array('id' => 'addControl'))?></a></p>

