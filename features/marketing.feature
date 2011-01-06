Feature: collect marketing metrics
  As an owner of this site
  I want to collect marketing metrics
  So that I may learn more about my current and potential customers

  Scenario: visitor gets cookie on first visit
    When I go to the home page
    Then a marketing_metric should exist with landing_page: "http://localhost/recipeBook/", activity: "new visit"

  Scenario: create marketing metric when user registers
    When I go to the home page
    And I fill in "username" with "testUser1"
    And I fill in "email" with "testUser1@somewhere.com"
    And I fill in "password" with "Password1"
    And I choose "free" from "plan"
    And I press "signupButton"
    Then a marketing_metric should exist with account_id: 1, activity: "signup"

  Scenario: create marketing metric when user signs in
    When I go to the home page
    And I fill in "username" with "testUser1"
    And I fill in "email" with "testUser1@somewhere.com"
    And I fill in "password" with "Password1"
    And I choose "free" from "plan"
    And I press "signupButton"
    And I follow "logout"
    And I login with username: "testUser1", password: "Password1"
    Then 2 marketing_metrics should exist with account_id: 1
    And a marketing_metric should exist with account_id: 1, activity: "signup"
    And a marketing_metric should exist with account_id: 1, activity: "login"

  Scenario: create marketing metric when user invites friend
    Given a user exists with username: "testUser1", email: "testUser1@somewhere.com", password: "Password1"
    And a book exists with owner_id: 1, plan: "medium"
    And I am logged in with username: "testUser1", password: "Password1"
    And I follow "settings"
    And I follow "invite friend"
    When I fill in "username" with "testFriend1"
    And I fill in "email" with "testFriend1@somewhere.com"
    And I press "Send Invitation"
    Then a marketing_metric should exist with activity: "invite friend", invitee_id: 2

