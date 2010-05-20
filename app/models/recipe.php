<?php

class Recipe extends Model
{
  const MAIN_DISH = 1;
  const SIDE_DISH = 2;
  const APPETIZER = 3;
  const BREAD     = 4;
  const DESSERT   = 5;
  const BEVERAGE  = 6;

  function getCategoryMap() {
    return array(
      'Main Dish' => self::MAIN_DISH,
      'Side Dish' => self::SIDE_DISH,
      'Appetizer' => self::APPETIZER,
      'Bread'     => self::BREAD,
      'Dessert'   => self::DESSERT,
      'Beverage'  => self::BEVERAGE);
  }

  function getAllNames() {
    return $this->db->select('id, name, category')->order_by('category, name')->get('recipes')->result();
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

