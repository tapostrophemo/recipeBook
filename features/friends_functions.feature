Feature: things a friend can do with your cookbook
  As an owner of a cookbook subscription
  I want to ensure my friends can perform certain actions with my cookbook

  Background:
    Given a user exists with username: "testUser1", email: "testUser1@somewhere.com", password: "Password1"
    And a book exists with owner_id: 1, plan: "medium"
    And a user exists with username: "testFriend1", email: "testFriend1@somewhere.com", password: "Password1"
    And an editor exists with user_id: 2, book_id: 1
    And a recipe exists with name: "recipe name", book_id: 1
    And I am logged in with username: "testFriend1", password: "Password1"

  Scenario: friends are allowed to add recipes
    When I follow "add recipe"
    Then I should be on the add recipe page

  Scenario: friends are allowed to edit recipes
    When I follow "recipe name"
    And I follow "edit"
    Then I should be on the "edit/1" page

  Scenario: friends are not allowed to delete recipes
    When I follow "recipe name"
    Then I should not see "delete"
    When I go to the "delete/1" page
    Then I should see "Only cookbook owners are allowed to delete recipes"

  Scenario: friends are not allowed to manage list of friends
    Then I should not see "manage"
    When I go to the manage friends page
    Then I should see "Only cookbook owners are allowed to view that screen"

