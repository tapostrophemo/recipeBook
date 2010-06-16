<?php if (!$this->session->userdata('in_beta')): ?>

<ul id="controls">
<?php if ($this->session->userdata('logged_in')): ?>

<?php $segment = $this->uri->segment(1, ''); if ($segment == ''): ?>
 <li><?=anchor('add', 'add recipe', array('id' => 'addControl'))?></li>
<?php elseif ($segment == 'recipe'): ?>
 <li><?=anchor('edit/'.$recipe->id, 'edit', array('id' => 'editControl'))?></li>
 <li><?=anchor('delete/'.$recipe->id, 'delete')?></li>
<?php endif; ?>

 <li><?=anchor('#', 'toggle color', array('id' => 'colorToggleControl'))?></li>

<?php if ($this->session->userdata('is_admin')): ?>
 <li><?=anchor('/admin', 'admin')?></li>
<?php endif; ?>

 <li><?=anchor('logout', 'logout')?></li>

<?php else: ?>

 <li><?=anchor('#', 'toggle color', array('id' => 'colorToggleControl'))?></li>
 <li><?=anchor('login', 'login')?></li>

<?php endif; ?>
</ul>

<?php endif; ?>

