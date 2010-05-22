Feature: view recipes
  As a user of recipeBook
  I want to view recipes and useful commentary about them

  Scenario: view helpful message when recipe not found
    Given the following recipes exist
      | name           | category |
      | Eggs and Bacon | 1        |
      | Brown Rice     | 2        |
      | Potato Skins   | 3        |
    When I go to the "recipe/4" page
    Then I should see the following categories and recipes
      | Category    | Recipe         |
      | Main Dishes | Eggs and Bacon |
      | Side Dishes | Brown Rice     |
      | Appetizers  | Potato Skins   |
    And I should see "That recipe was not found"

