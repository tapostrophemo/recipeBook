<ul id="controls">
<?php $segment = $this->uri->segment(1, ''); if ($segment == ''): ?>
 <li><?=anchor('add', 'add recipe', array('id' => 'addControl'))?></li>
<?php elseif ($segment == 'recipe'): ?>
 <li><?=anchor('edit/'.$recipe->id, 'edit', array('id' => 'editControl'))?></li>
 <li><?=anchor('delete/'.$recipe->id, 'delete')?></li>
<?php endif; ?>
</ul>

