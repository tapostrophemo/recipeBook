Feature: administrator adds/edits users
  As an administrator of the recipe book
  I want to be able to add and edit users
  So that more users can use the system

  Background:
    Given a user exists with username: "testAdmin1", is_admin: "1", email: "testAdmin1@somewhere.com", password: "Password1"
    And I am logged in with username: "testAdmin1", password: "Password1"
    And I follow "admin"

  Scenario: add a user
    When I follow "Add User"
    And I fill in "username" with "testUser1"
    And I fill in "password" with "Password1"
    And I fill in "email" with "testUser1@somewhere.com"
    And I press "Save"
    Then a user should exist with username: "testUser1", email: "testUser1@somewhere.com"
    When I follow "List Users"
    Then I should see the following users
      | Username   | Email                    |
      | testAdmin1 | testAdmin1@somewhere.com |
      | testUser1  | testUser1@somewhere.com  |
    When I follow "logout"
    And I login with username: "testUser1", password: "Password1"
    Then I should see "add recipe"
    But I should not see "admin"

  Scenario: add user validations
    When I follow "Add User"
    And I fill in "username" with " "
    And I fill in "password" with " "
    And I fill in "email" with " "
    And I press "Save"
    Then I should see "The Username field is required"
    And I should see "The Password field is required"
    And I should see "The Email field is required"

