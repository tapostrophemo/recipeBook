<?php if (!isset($recipes)) $recipes = array(); ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td width="33%"><?=$this->load->view('book/category', array('name' => 'Appetizers', 'code' => Recipe::APPETIZER, 'recipes' => $recipes))?></td>
  <td width="33%"><?=$this->load->view('book/category', array('name' => 'Side Dishes', 'code' => Recipe::SIDE_DISH, 'recipes' => $recipes))?></td>
  <td width="33%"><?=$this->load->view('book/category', array('name' => 'Breads', 'code' => Recipe::BREAD, 'recipes' => $recipes))?></td>
 </tr>
 <tr>
  <td><?=$this->load->view('book/category', array('name' => 'Main Dishes', 'code' => Recipe::MAIN_DISH, 'recipes' => $recipes))?></td>
  <td><?=$this->load->view('book/category', array('name' => 'Beverages', 'code' => Recipe::BEVERAGE, 'recipes' => $recipes))?></td>
  <td><?=$this->load->view('book/category', array('name' => 'Desserts', 'code' => Recipe::DESSERT, 'recipes' => $recipes))?></td>
 </tr>
</table>

