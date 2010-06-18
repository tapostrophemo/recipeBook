Feature: Table of Contents
  As a visitor of the recipeBook site
  I want to see the table of contents
  So that I can choose a tasty recipe to make

  Background:
    Given a user exists with username: "testUser1", email: "testUser1@somewhere.com", password: "Password1"
    And a book exists with owner_id: 1

  Scenario: View recipes alphabetically under various categories in the TOC
    Given the following recipes exist
      | name           | category | book_id |
      | Eggs and Bacon | 1        | 1       |
      | Brown Rice     | 2        | 1       |
      | Potato Skins   | 3        | 1       |
      | Tortillas      | 4        | 1       |
      | Pound Cake     | 5        | 1       |
      | Hot Chocolate  | 6        | 1       |
      | Carrot Sticks  | 2        | 1       |
      | Horchata       | 6        | 1       |
    When I go to the table of contents page
    Then I should see the following categories and recipes
      | Category    | Recipe                   |
      | Main Dishes | Eggs and Bacon           |
      | Side Dishes | Brown Rice Carrot Sticks |
      | Appetizers  | Potato Skins             |
      | Breads      | Tortillas                |
      | Desserts    | Pound Cake               |
      | Beverages   | Horchata Hot Chocolate   |

