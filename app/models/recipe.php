<?php

class Recipe extends Model
{
  function getCategoryMap() {
    return array(
      'Main Dish' => 1,
      'Side Dish' => 2,
      'Appetizer' => 3,
      'Bread'     => 4,
      'Dessert'   => 5,
      'Beverage'  => 6);
  }

  function getById($id) {
    $query = $this->db->select('id, name, category, photo, ingredients, instructions')->where('id', $id)->get('recipes');
    if ($query->num_rows() == 0) {
      return null;
    }
    $recipe = $query->row();
    $recipe->ingredients = split("\n", $recipe->ingredients);
    $recipe->instructions = split("\n", $recipe->instructions);
    return $recipe;
  }
}

