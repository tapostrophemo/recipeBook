Feature: Add recipes
  As a user of the recipeBook site
  I want to add recipes

  Scenario: Add recipe
    Given I am on the home page
    And I follow "add recipe"
    And I fill in "name" with "Peanut Butter and Jelly"
    And I fill in "ingredients" with "2 slices of bread\npeanut butter\njelly (of your favorite flavor)"
    And I fill in "instructions" with "spread peanut butter on one slice of bread\nspread jelly on the other\nsmush the two pieces of bread together and eat"
#Then I debug
# NB: /var/lib/gems/1.8/gems/webrat-0.7.1/lib/webrat/core/elements/form.rb - this has why file fields break!!!
# until I figure out how to work with it (maybe always upload a file?), I have to disable the file fields
# in app/views/recipe/(add|edit).php for cucumber
    When I press "Save"
    Then I should see "Recipe created"
    And a recipe should exist with name: "Peanut Butter and Jelly"
    And I should see "Peanut Butter and Jelly"
    #... or I should be on the recipe page with title "Crab Cakes"
    And I should not see "Table of Contents"
    When I go to the home page
    Then I should see the following categories and recipes
      | Category    | Recipe                  |
      | Main Dishes | Peanut Butter and Jelly |

  Scenario: Add recipe validations
    Given I am on the home page
    And I follow "add recipe"
    And I fill in "name" with " "
    And I press "Save"
    Then I should see "The recipe name field is required"

