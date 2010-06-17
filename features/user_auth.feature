Feature: User Authentication
  As a registered user of the recipeBook site
  I want to be able to log in and out of the site

  Background:
    Given a user exists with username: "testUser1", email: "testUser1@somewhere.com", password: "Password1"
    And I go to the home page
    Then I should see "login"
    But I should not see "add recipe"
    And I should not see "logout"
    When I follow "login"

  Scenario: low-level user login
    When I fill in "username" with "testUser1"
    And I fill in "password" with "Password1"
    And I press "Login"
    Then I should see "Table of Contents"
    And I should see "Welcome back, testUser1"
    And I should see "logout"

  Scenario: cookbook title changes when user logged in
    When I am on the home page
    Then I should see "The Slice-up Cookbook"
    When I am logged in with username: "testUser1", password: "Password1"
    Then I should see "testUser1's Slice-up Cookbook"
    When I follow "logout"
    Then I should see "The Slice-up Cookbook"

  Scenario: registered user with bad password gets warning message
    When I fill in "username" with "testUser1"
    And I fill in "password" with "badPassword1"
    And I press "Login"
    Then I should see "Invalid username or password"
    And I should see "login"
    But I should not see "logout"

  Scenario: unregistered user gets warning message
    When I fill in "username" with "nonUser1"
    And I fill in "password" with "nonPassword1"
    And I press "Login"
    Then I should see "Invalid username or password"

