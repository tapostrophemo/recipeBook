Feature: Table of Contents
  As a visitor of the recipeBook site
  I want to see the table of contents
  So that I can choose a tasty recipe to make

  Scenario: View recipes alphabetically under various categories in the TOC
    Given the following recipes exist
      | name           | category |
      | Eggs and Bacon | 1        |
      | Brown Rice     | 2        |
      | Potato Skins   | 3        |
      | Tortillas      | 4        |
      | Pound Cake     | 5        |
      | Hot Chocolate  | 6        |
      | Carrot Sticks  | 2        |
      | Horchata       | 6        |
    When I go to the table of contents page
    Then I should see the following categories and recipes
      | Category    | Recipe                   |
      | Main Dishes | Eggs and Bacon           |
      | Side Dishes | Brown Rice Carrot Sticks |
      | Appetizers  | Potato Skins             |
      | Breads      | Tortillas                |
      | Desserts    | Pound Cake               |
      | Beverages   | Horchata Hot Chocolate   |

