<h3><?=$name?></h3>
<ul>
<?php foreach ($recipes as $recipe): if ($code == $recipe->category): ?>
 <li><?=anchor('recipe/'.$recipe->id, $recipe->name)?></li>
<?php endif; endforeach; ?>
</ul>

