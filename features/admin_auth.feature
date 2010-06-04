Feature: Administrator Login
  As an administrator of the recipe book
  I want to ensure only authorized admin users are able to login

  Background:
    Given a user exists with username: "testAdmin1", is_admin: "1", email: "testAdmin1@somewhere.com", password: "Password1"
    And a user exists with username: "testUser1", email: "testUser1@somewhere.com", password: "Password1"

  Scenario: valid administrator can see admin link and menu
    When I am logged in with username: "testAdmin1", password: "Password1"
    Then I should see "admin"
    When I follow "admin"
    Then I should see "Admin Menu"
    And I should see "List Users"
    And I should see "Add User"
    And I should see "Registration/Activation Report"

  Scenario: non-admin cannot see admin link nor menu
    When I am logged in with username: "testUser1", password: "Password1"
    Then I should not see "admin"
    When I go to the admin menu page
    Then I should see "Authorized users only!"
    And I should see "Table of Contents"

