Feature: edit recipes
  As a user of recipeBook
  I want to edit recipes

  Background:
    Given a user exists with username: "testUser1", email: "testUser1@somewhere.com", password: "Password1"
    And I am logged in with username: "testUser1", password: "Password1"

  Scenario: edit recipe details
    Given a recipe exists with name: "recipe name", category: 4, ingredients: "list of ingredients", instructions: "list of instructions"
    When I go to the "recipe/1" page
    And I follow "edit"
    Then the "name" field should contain "recipe name"
    And the "category" field should contain "4"
    And the "ingredients" field should contain "list of ingredients"
    And the "instructions" field should contain "list of instructions"
    When I fill in "name" with "another name"
    And I select "Appetizer" from "category"
    And I fill in "ingredients" with "other ingredients"
    And I fill in "instructions" with "other instructions"
    And I press "Save"
    Then I should see "Recipe updated"
    And I should see "another name"
    And I should see "Ingredients other ingredients"
    And I should see "Instructions other instructions"

  Scenario: edit recipe validations
    Given a recipe exists with name: "recipe name", category: 4, ingredients: "list of ingredients", instructions: "list of instructions"
    When I go to the "recipe/1" page
    And I follow "edit"
    And I fill in "name" with " "
    And I select "Beverage" from "category"
    And I fill in "ingredients" with "ingredient 1 2 3"
    And I fill in "instructions" with "instruction 1 2 3"
    And I press "Save"
    Then I should see "The recipe name field is required"
    # NB: the following seems to be broken in CI with set_value(...)
    #And the "name" field should contain "recipe name"
    And the "category" field should contain "6"
    And the "ingredients" field should contain "ingredient 1 2 3"
    And the "instructions" field should contain "instruction 1 2 3"

  Scenario: validate that recipe exists before editing
    Given a recipe exists with name: "recipe name", category: 4
    When I go to the "edit/2" page
    Then I should see "That recipe was not found"
    And I should see "Table of Contents"

  Scenario: must be logged in to edit recipes - no cheating with the back button
    Given a recipe exists with name: "recipe name", category: 4
    When I follow "logout"
    And I go to the "edit/1" page
    Then I should see "You must be logged in to edit recipes"
    And I should see "Login"
    And I should see "login"
    But I should not see "logout"

