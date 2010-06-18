Feature: delete recipes
  As a user of recipeBook
  I want to delete recipes

  Background:
    Given a user exists with username: "testUser1", email: "testUser1@somewhere.com", password: "Password1"
    And a book exists with owner_id: 1
    And a recipe exists with name: "recipe name", category: 4, book_id: 1
    And I am logged in with username: "testUser1", password: "Password1"

  Scenario: delete recipe
    When I go to the "recipe/1" page
    And I follow "delete"
    Then a recipe should not exist with id: 1, name: "recipe name"
    And I should see "Recipe for 'recipe name' deleted"
    And I should see "Table of Contents"

  Scenario: validate that recipe exists before deleting
    When I go to the "delete/2" page
    Then I should see "That recipe was not found"
    And I should see "Table of Contents"

  Scenario: must be logged in to delete recipes - no cheating with the back button
    When I follow "logout"
    And I go to the "delete/1" page
    Then I should see "You must be logged in to delete recipes"
    And I should see "Login"
    And I should see "login"
    But I should not see "logout"

