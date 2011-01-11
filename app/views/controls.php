<?php
$segment = $this->uri->segment(1, '');
?>

<ul id="controls">

<?php if ($this->session->userdata('logged_in')): ?>

<?php if ($segment != 'toc' && $segment != 'newpass'): ?>
 <li><?=anchor('/toc', 'home')?></li>
<?php endif; ?>

<?php if ($segment == 'toc' && !$this->session->userdata('is_suspended')): ?>
 <li><?=anchor('add', 'add recipe', array('id' => 'addControl'))?></li>
<?php elseif ($segment == 'recipe' && !$this->session->userdata('is_suspended')): ?>
 <li><?=anchor('edit/'.$recipe->id, 'edit', array('id' => 'editControl'))?></li>

 <?php if ($this->session->userdata('is_owner') && $segment != 'add'): ?>
 <li><?=anchor('delete/'.$recipe->id, 'delete')?></li>
 <?php endif; ?>
<?php endif; ?>

<?php if ($segment == 'toc'): ?>
 <li><?=anchor('/settings', 'settings')?></li>
<?php endif; ?>

 <li><?=anchor('logout', 'logout')?></li>

<?php else: ?>

 <?php if ($segment != 'acceptinvitation'): ?>
 <li><?=anchor('login', 'login')?></li>
 <?php endif; ?>

<?php endif; ?>

</ul>

