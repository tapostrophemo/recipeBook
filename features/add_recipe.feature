Feature: Add recipes
  As a user of the recipeBook site
  I want to add recipes

  Scenario: Add recipe
    Given I am on the home page
    And I follow "add recipe"
    And I fill in "name" with "Peanut Butter and Jelly"
    And I fill in "ingredients" with "2 slices of bread\npeanut butter\njelly (of your favorite flavor)"
    And I fill in "instructions" with "spread peanut butter on one slice of bread\nspread jelly on the other\nsmush the two pieces of bread together and eat"
    When I press "Save"
    Then I should see "Recipe created"
    And a recipe should exist with name: "Peanut Butter and Jelly"
    And I should see "Peanut Butter and Jelly"
    And I should not see "Table of Contents"
    When I go to the home page
    Then I should see the following categories and recipes
      | Category    | Recipe                  |
      | Main Dishes | Peanut Butter and Jelly |

  Scenario: Add recipe validations
    Given I am on the home page
    And I follow "add recipe"
    And I fill in "name" with " "
    When I press "Save"
    Then I should see "The recipe name field is required"

  Scenario: Preserves values if validation fails
    Given I am on the home page
    And I follow "add recipe"
    And I fill in "name" with " "
    And I select "Side Dish" from "category"
    And I fill in "ingredients" with " list of ingredients "
    And I fill in "instructions" with " list of instructions "
    When I press "Save"
    Then the "category" field should contain "2"
    And the "ingredients" field should contain "list of ingredients"
    And the "instructions" field should contain "list of instructions"

