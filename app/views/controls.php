<?php
$segment = $this->uri->segment(1, '');
?>

<ul id="controls">

<?php if ($this->session->userdata('logged_in')): ?>

<?php if ($segment != 'toc'): ?>
 <li><?=anchor('/toc', 'home')?></li>
<?php endif; ?>

<?php if ($segment == 'toc' && !$this->session->userdata('is_suspended')): ?>
 <li><?=anchor('add', 'add recipe', array('id' => 'addControl'))?></li>
<?php elseif ($segment == 'recipe' && !$this->session->userdata('is_suspended')): ?>
 <li><?=anchor('edit/'.$recipe->id, 'edit', array('id' => 'editControl'))?></li>

 <?php if ($this->session->userdata('is_owner')): ?>
 <li><?=anchor('delete/'.$recipe->id, 'delete')?></li>
 <?php endif; ?>
<?php endif; ?>

<?php if ($this->session->userdata('is_owner') && $segment != 'manage'): ?>
 <li><?=anchor('/manage', 'manage')?></li>
<?php endif; ?>

 <li><?=anchor('logout', 'logout')?></li>

<?php else: ?>

 <li><?=anchor('login', 'login')?></li>

<?php endif; ?>

</ul>

