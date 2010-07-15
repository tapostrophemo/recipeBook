Feature: site administration, marketing reports, etc.
  As an operator of this site
  I want to have a way to perform various administrative and reporting tasks

  Background:
    Given an admin_user exists with username: "testAdmin1", password: "Password1"

  Scenario: admin login
    Given I go to the admin page
    When I fill in "username" with "testAdmin1"
    And I fill in "password" with "Password1"
    And I press "Login"
    Then I should see "Admin Menu"
    And I should see "Marketing Metrics"
    When I follow "Logout"
    Then I should see "Login"

  Scenario: invalid admin login
    Given I go to the admin page
    When I fill in "username" with "notTestAdmin"
    And I fill in "password" with "notPassword"
    And I press "Login"
    Then I should see "Authorized Administrators Only!"

  Scenario: view marketing metrics report
    Given a user exists with username: "testUser1", email: "testUser1@somewhere.com", password: "Password1"
    And a book exists with owner_id: 1, plan: "medium"
    And a marketing_metric exists with account_id: 1, activity: "signup", cookie_id: "abc123", created_at: "2010-07-01", referring_url: "referrer", landing_page: "landing page"
    When I am logged in with admin username: "testAdmin1", password: "Password1"
    When I follow "Marketing Metrics"
    # TODO: put expected results into tabular format
    # header row
    Then I should see "Account # Cookie Username First visit Referrer Landing page Last activity Registration date"
    # data row; TODO: figure out what to put for reg. date
    And I should see "1 abc123 testUser1 2010-07-01 00:00:00 referrer landing page signup"

#    Then I should see "TODO: write metrics report"
#    Then a marketing_metric should exist with account_id: 1, activity: "signup"
#    And a marketing_metric exists with landing_page: "http://localhost/recipeBook/", activity: "new visit"
#    Then a marketing_metric should exist with account_id: 1, activity: "login"
#    And marketing_metric 1 should have been updated

