Feature: delete recipes
  As a user of recipeBook
  I want to delete recipes

  Scenario: delete recipe
    Given a recipe exists with name: "recipe name", category: 4
    When I go to the "recipe/1" page
    And I follow "delete"
    Then a recipe should not exist with id: 1, name: "recipe name"
    And I should see "Recipe deleted"
    And I should see "Table of Contents"

