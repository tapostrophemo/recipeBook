Feature: view recipes
  As a user of recipeBook
  I want to view recipes

  Background:
    Given a user exists with username: "testUser1", email: "testUser1@somewhere.com", password: "Password1"
    And a book exists with owner_id: 1, plan: "free"

  Scenario: view recipe details
    Given a recipe exists with name: "Peanut Butter and Jelly", book_id: 1, category: 1, ingredients: "2 slices of bread\npeanut butter\njelly (of your favorite flavor)", instructions: "spread peanut butter on one slice of bread\nspread jelly on the other\nsmush the two pieces of bread together and eat"
    When I go to the "recipe/1" page
    Then I should see "Peanut Butter and Jelly"
    And I should see "Ingredients 2 slices of bread peanut butter jelly (of your favorite flavor)"
    And I should see "Instructions spread peanut butter on one slice of bread spread jelly on the other smush the two pieces of bread together and eat"

  Scenario: view message when recipe not found
    Given the following recipes exist
      | name           | category | book_id |
      | Eggs and Bacon | 1        | 1       |
      | Brown Rice     | 2        | 1       |
      | Potato Skins   | 3        | 1       |
    When I go to the "recipe/4" page
    Then I should see the following categories and recipes
      | Category    | Recipe         |
      | Main Dishes | Eggs and Bacon |
      | Side Dishes | Brown Rice     |
      | Appetizers  | Potato Skins   |
    And I should see "That recipe was not found"

