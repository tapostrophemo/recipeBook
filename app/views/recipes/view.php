<div id="ingredientsList">
<h3>Ingredients</h3>
<ul>
<?php foreach ($recipe->ingredients as $ingredient): ?>
 <li><?=$ingredient?></li>
<?php endforeach; ?>
</ul>
</div>

<div id="instructionsList">
<h3>Instructions</h3>
<?php foreach ($recipe->instructions as $instruction): ?>
<p><?=$instruction?></p>
<?php endforeach; ?>
</div>

<div style="clear:both"></div>

