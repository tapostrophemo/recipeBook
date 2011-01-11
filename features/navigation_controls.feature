Feature: states of navigation controls
  As an operator of the site
  I want to ensure users of the site are limited to appropriate actions
  By displaying only appropriate navigation controls on appropriate screens

  Background:
    Given a user exists with name: "Abe", username: "testUser1", email: "testUser1@somewhere.com", password: "Password1"
    And a book exists with owner_id: 1, plan: "medium"
    And a user exists with name: "Bob", username: "testFriend1", email: "testFriend1@somewhere.com", password: "Password1"
    And an editor exists with user_id: 2, book_id: 1
    And a recipe exists with name: "recipe name", book_id: 1

  Scenario: navigation controls for a non-user or logged-out user of the site
    Given I am on the home page
    Then I should have the following controls:
      |login|
    When I follow "login"
    Then I should have the following controls:
      |login|

  Scenario: navigation controls for a cookbook owner
    Given I am logged in with username: "testUser1", password: "Password1"
    Then I should have the following controls:
      |add recipe|
      |settings  |
      |logout    |
    # NB: next bit is tricky, due to testing AJAX
    When I follow "add recipe"
    Then I should have the following controls:
      |home  |
      |logout|
    When I follow "home"
    And I follow "recipe name"
    Then I should have the following controls:
      |home  |
      |edit  |
      |delete|
      |logout|
    When I follow "home"
    And I follow "settings"
    Then I should have the following controls:
      |home  |
      |logout|

  Scenario: navigation controls for an active cookbook editor
    Given I am logged in with username: "testFriend1", password: "Password1"
    Then I should have the following controls:
      |add recipe|
      |settings  |
      |logout    |

  Scenario: navigation controls for a suspended cookbook editor
    Given a user exists with name: "Cal", username: "testFriend2", email: "testFriend2@somewhere.com", password: "Password1"
    And an editor exists with user_id: 3, book_id: 1, status: "suspended"
    And I am logged in with username: "testFriend2", password: "Password1"
    Then I should have the following controls:
      |settings|
      |logout  |

