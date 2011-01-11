Feature: User Authentication
  As a registered user of the recipeBook site
  I want to be able to log in and out of the site

  Background:
    Given a user exists with name: "Abe", username: "testUser1", email: "testUser1@somewhere.com", password: "Password1"
    And a book exists with owner_id: 1, plan: "free"
    And a user exists with name: "Bob", username: "testUser2", email: "testUser2@somewhere.com", password: "Password2"
    And an editor exists with user_id: 2, book_id: 1
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
    And the "last_login_at" field for user "testUser1" should be today

  Scenario: cookbook title changes to owner name when user logged in
    When I am on the home page
    Then I should see "The Slice-up Cookbook"
    When I am logged in with username: "testUser1", password: "Password1"
    Then I should see "testUser1's Slice-up Cookbook"
    When I follow "logout"
    Then I should see "The Slice-up Cookbook"

  Scenario: Name of owner appears in header for editor/user
    When I login with username: "testUser2", password: "Password2"
    Then I should see "testUser1's Slice-up Cookbook"

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

  Scenario: password reset validations
    Given I am logged in with username: "testUser1", password: "Password1"
    When I follow "settings"
    And I follow "reset password"
    And I fill in "password" with " "
    And I fill in "passconf" with " "
    And I press "Update Password"
    Then I should see "The password field is required"
    And I should see "The password confirmation field is required"
    When I fill in "password" with "newPassword"
    And I fill in "passconf" with "xnewPassword"
    And I press "Update Password"
    Then I should see "The password confirmation field does not match the password field"

