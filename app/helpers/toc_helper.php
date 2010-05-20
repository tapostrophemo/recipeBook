<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('writeRecipesInCategory')) {
  function writeRecipesInCategory($name, $code, $recipes) {
    echo "<h3>$name</h3>\n";
    echo "<ul>\n";
    foreach ($recipes as $recipe) {
      if ($code == $recipe->category)
        echo '<li>'.anchor('recipe/'.$recipe->id, $recipe->name)."</li>\n";
    }
    echo "</ul>\n";
  }
}

