<?php if (!isset($recipes)) $recipes = array(); ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td width="33%"><?php writeRecipesInCategory('Appetizers', Recipe::APPETIZER, $recipes); ?></td>
  <td width="33%"><?php writeRecipesInCategory('Side Dishes', Recipe::SIDE_DISH, $recipes); ?></td>
  <td width="33%"><?php writeRecipesInCategory('Breads', Recipe::BREAD, $recipes); ?></td>
 </tr>
 <tr>
  <td><?php writeRecipesInCategory('Main Dishes', Recipe::MAIN_DISH, $recipes); ?></td>
  <td><?php writeRecipesInCategory('Beverages', Recipe::BEVERAGE, $recipes); ?></td>
  <td><?php writeRecipesInCategory('Desserts', Recipe::DESSERT, $recipes); ?></td>
 </tr>
</table>

