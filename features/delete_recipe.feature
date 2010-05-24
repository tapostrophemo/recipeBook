Feature: delete recipes
  As a user of recipeBook
  I want to delete recipes

  Background:
    Given a user exists with username: "testUser1", email: "testUser1@somewhere.com", password: "Password1"
    And I am logged in with username: "testUser1", password: "Password1"

  Scenario: delete recipe
    Given a recipe exists with name: "recipe name", category: 4
    When I go to the "recipe/1" page
    And I follow "delete"
    Then a recipe should not exist with id: 1, name: "recipe name"
    And I should see "Recipe for 'recipe name' deleted"
    And I should see "Table of Contents"

  Scenario: validate that recipe exists before deleting
    Given a recipe exists with name: "recipe name", category: 4
    When I go to the "delete/2" page
    Then I should see "That recipe was not found"
    And I should see "Table of Contents"

