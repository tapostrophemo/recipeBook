<?php

class Recipe extends Model
{
  function getById($id) {
    $query = $this->db->select('name, photo, ingredients, instructions')->where('id', $id)->get('recipes');
    if ($query->num_rows() == 0) {
      return null;
    }
    $recipe = $query->row();
    $recipe->ingredients = split("\n", $recipe->ingredients);
    $recipe->instructions = split("\n", $recipe->instructions);
    return $recipe;
  }
}

