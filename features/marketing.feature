Feature: collect marketing metrics
  As an owner of this site
  I want to collect marketing metrics
  So that I may learn more about my current and potential customers

  Scenario: visitor gets cookie on first visit
    When I go to the home page
    Then a marketing_metric should exist with landing_page: "http://localhost/recipeBook/", activity: "new visit"

  Scenario: marketing metrics updated when user registers
    When I go to the home page
    And I fill in "username" with "testUser1"
    And I fill in "email" with "testUser1@somewhere.com"
    And I fill in "password" with "Password1"
    And I choose "free" from "plan"
    And I press "signupButton"
    Then a marketing_metric should exist with account_id: 1, activity: "signup"

  Scenario: marketing metrics updated when user signs in
    When I go to the home page
    And I fill in "username" with "testUser1"
    And I fill in "email" with "testUser1@somewhere.com"
    And I fill in "password" with "Password1"
    And I choose "free" from "plan"
    And I press "signupButton"
    And I follow "logout"
    When I wait for 2 seconds
    And I login with username: "testUser1", password: "Password1"
    Then a marketing_metric should exist with account_id: 1, activity: "login"
    And marketing_metric 1 should have been updated

