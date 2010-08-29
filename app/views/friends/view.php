<?php
$segment = $this->uri->segment(1, '');
$total = 0;
?>

<div id="ingredientsList">

<h3>Friends</h3>
<p>Invite others to edit your cookbook. (Suspend them if they're misbehaving. Re-activate them when
 you're back on speaking terms.)</p>

<?php if ($this->session->userdata('is_owner') && $segment == 'manage'): ?>
<p><?=anchor('friends/add', 'invite friend', array('id' => 'addControl'))?></p>
<?php endif; ?>

<table>
 <tr>
  <td></td>
  <th>Name</th>
  <th>Status</th>
  <td></td>
 </tr>
<?php foreach ($friends as $friend): ?>
 <tr>
  <td><?=++$total?></td>
  <td><?=$friend->username?></td>
  <td><?=$friend->status?></td>
  <td>
  <?php if ($friend->status != 'suspended'): ?>
   <?=anchor('/suspend/'.$friend->id, 'suspend')?>
  <?php else: ?>
   <?=anchor('/reactivate/'.$friend->id, 're-activate')?>
  <?php endif; ?>
  </td>
 </tr>
<?php endforeach; ?>
<?php while (++$total <= $max): ?>
 <tr>
  <td><?=$total?></td>
  <td>_________</td>
  <td></td>
  <td></td>
 </tr>
<?php endwhile; ?>
</table>

</div>

