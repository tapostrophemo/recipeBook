Feature: Signup for the application
  As a future user of the site
  I want to sign up
  So that I can use the site

  Scenario: happy path
    When I go to the home page
    And I fill in "username" with "testUser1"
    And I fill in "email" with "testUser1@somewhere.com"
    And I press "signupButton"
    Then I should see "Please enter a password and choose a plan."
    And I should see "testUser1"
    And I should see "testUser1@somewhere.com"
    And I should see "Small (free)"
    And I should see "Medium ($12.99/year)"
    And I should see "Large ($24.99/year)"
    When I choose "medium" from "plan"
    And I fill in "password" with "Password1"
    And I press "signupButton"
    Then I should be logged in
    And I should see "Your account has been created"
    And a user should exist with username: "testUser1"
    And a book should exist with owner_id: 1, plan: "medium"

  Scenario: validates required fields
    When I signup with username: " ", email: " "
    Then I should see "The username field is required"
    And I should see "The email field is required"

  Scenario: validates email
    When I signup with username: "bob", email: "emailtypo2somewhere.com"
    Then I should see "The email field must contain a valid email address."

  Scenario: validates maxlength of username
    When I signup with username: "0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345", email: "testUser1@somewhere.com"
    Then I should see "The username field can not exceed 255 characters in length."

  Scenario: desired username already chosen
    Given a user exists with username: "testUser1", email: "testUser1@somewhere.com", password: "Password1"
    When I signup with username: "testUser1", email: "testUser1@somewhere.com"
    Then I should see "That username is already taken"

  Scenario: validates password on signup screen two
    When I signup with username: "bob", email: "bob@somewhere.com"
    And I fill in "password" with " "
    # ...and I do not select a plan
    And I press "signupButton"
    Then I should see "The password field is required"
    And I should see "The plan field is required"

