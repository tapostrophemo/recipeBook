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

  Scenario: suspended friends are not allowed to edit your cookbook
    Given a user exists with username: "testFriend2", email: "testFriend2@somewhere.com", password: "Password1"
    And an editor exists with user_id: 3, book_id: 1, status: "suspended"
    When I follow "logout"
    And I am logged in with username: "testFriend2", password: "Password1"
    Then I should see "Your editing privileges have been suspended. Please contact this cookbook's owner."
    And I should not see "add recipe"
    When I follow "recipe name"
    Then I should not see "edit" within "#controls"
    When I go to the add recipe page
    Then I should see "Your account is suspended; you may only view recipes"
    When I go to the "edit/1" page
    Then I should see "Your account is suspended; you may only view recipes"

