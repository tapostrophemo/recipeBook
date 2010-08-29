Feature: Signup for the application
  As a future user of the site
  I want to sign up
  So that I can use the site

  Background:
    Given a user exists with username: "testUser2", email: "testUser2@somewhere.com", password: "Password1"
    And a book exists with owner_id: 1, plan: "free"
    And a recipe exists with book_id: 1, name: "Cold Cereal"

  Scenario: happy path
    When I go to the home page
    Then I should see "Small (free)"
    And I should see "Medium ($12.99/year)"
    And I should see "Large ($24.99/year)"
    When I fill in "username" with "testUser1"
    And I fill in "email" with "testUser1@somewhere.com"
    And I fill in "password" with "Password1"
    And I choose "free" from "plan"
    And I press "signupButton"
    Then I should be logged in
    And I should see "Your account has been created"
    And a user should exist with username: "testUser1"
    And the "created_at" field for user "testUser1" should be today
    And a book should exist with owner_id: 2, plan: "free"
    And I should have 0 recipes in book: 2
    But I should not see "Cold Cereal"

  Scenario: validates required fields
    When I signup with username: " ", email: " ", password: " ", plan: " "
    Then I should see "The username field is required"
    And I should see "The email field is required"
    And I should see "The password field is required"
    And I should see "The plan field is required"

# TODO: uncomment when silly webrat can find my fields
#  Scenario: re-fills some fields on validation errors
#    When I signup with username: "tetsUser1", email: "testUser1@somewhere.com", password: " ", plan: "medium"
#    Then the "username" field should contain "testUser1"
#    And the "email" field should contain "testUser1@somewhere.com"
#    And the "plan" field should contain "medium"

  Scenario: validates email
    When I go to the home page
    And I fill in "email" with "emailtypo2somewhere.com"
    And I press "signupButton"
    Then I should see "The email field must contain a valid email address."

  Scenario: validates maxlength of username
    When I go to the home page
    And I fill in "username" with "0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345"
    And I press "signupButton"
    Then I should see "The username field can not exceed 255 characters in length."

  Scenario: desired username already chosen
    Given a user exists with username: "testUser1", email: "testUser1@somewhere.com", password: "Password1"
    When I signup with username: "testUser1", email: "testUser1@somewhere.com", password: "Password1", plan: "medium"
    Then I should see "That username is already taken"

# have to execute the PayPal integration tests manually...bummer!

#  Scenario: signup for paying plan, happy path
#    Given I go to the home page
#    When I fill in "username" with "testUser1"
#    And I fill in "email" with "testUser1@somewhere.com"
#    And I fill in "password" with "Password1"
#    And I choose "medium" from "plan"
#    And I press "signupButton"
#    And I login to PayPal as a buyer
#    And I press "Agree and Pay"
#    And I press "merchantRet"
#    Then I should be logged in
#    And I should see "Your account has been created"
#    And a user should exist with username: "testUser1"
#    And a book should exist with owner_id: 2, plan: "medium"

#  Scenario: signup for paying plan, unhappy path
#    Given I begin the signup process for a paid account
#    When I get to the PayPal screens
#    And I balk
#    Then I should see some friendly copy trying to persuade me to join anyway
#    And I should also see a comment form
#    But I should not have an account
#    And I should not be logged in

