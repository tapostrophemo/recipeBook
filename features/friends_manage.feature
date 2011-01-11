Feature: Add friends, family or other users to your cookbook
  As a paying subscriber to the site
  I want to allow friends and family to edit my cookbook

  Background:
    Given a user exists with name: "Abe", username: "testUser1", email: "testUser1@somewhere.com", password: "Password1"
    And a book exists with owner_id: 1, plan: "medium"
    And I am logged in with username: "testUser1", password: "Password1"

  Scenario: add a friend to my cookbook
    When I follow "settings"
    Then I should see "Friends"
    And I should see "1"
    And I should see "2"
    And I should see "10"
    When I follow "invite friend"
    And I fill in "name" with "Bob"
    And I fill in "email" with "testFriend1@somewhere.com"
    And I press "Send Invitation"
    Then I should see "An invitation was sent to testFriend1@somewhere.com"
    # NB: email shows only in test environment
    And I should see "Hi Bob."
    And I should see "Your friend, Abe (testUser1@somewhere.com) would like to share"
    And I should see an invitation link for user: "testFriend1"
    And a user should exist with name: "Bob"
    And an editor should exist with user_id: 2, book_id: 1, status: "invited"
    When I logout and "Bob" accepts my invitation as username "testFriend1"
    Then a user should exist with name: "Bob", username: "testFriend1", perishable_token: ""
    And an editor should exist with status: "active"
    When I follow "logout"
    And I follow "login"
    And I fill in "username" with "testFriend1"
    And I fill in "password" with "Password1"
    And I press "Login"
    Then I should be logged in

  Scenario: friend invitations must have a valid token
    When I follow "logout"
    And I go to accept an invitation with token "thisIsNotAValidToken"
    Then I should see "That invitation link is invalid or expired"
    And I should not be logged in

  Scenario: "add friend" validations
    Given a user exists with name: "XXX", username: "testFriendX", email: "testFriendX@somewhere.com", password: "Password1"
    When I follow "settings"
    And I follow "invite friend"
    When I fill in "name" with "testFriendX"
    And I fill in "email" with "testFriendX@somewhere.com"
    And I press "Send Invitation"
    Then I should see "That email address is already in use"
    When I fill in "name" with " "
    And I fill in "email" with " "
    And I press "Send Invitation"
    Then I should see "The name field is required"
    And I should see "The email field is required"
    When I fill in "name" with "testUserY"
    And I fill in "email" with "invalid2email.com"
    And I press "Send Invitation"
    Then I should see "The email field must contain a valid email address"

  Scenario: see my friends
    Given a user exists with name: "Bob", username: "testFriend1", email: "testFriend1@somewhere.com", password: "Password1"
    And an editor exists with user_id: 2, book_id: 1, status: "active"
    When I follow "settings"
    Then I should see "1 Bob (testFriend1) active"

  Scenario: view for invited friends shows no username if they have not yet accepted
    Given I follow "settings"
    And I follow "invite friend"
    And I fill in "name" with "Bob"
    And I fill in "email" with "testFriend1@somewhere.com"
    And I press "Send Invitation"
    When I go to the home page
    And I follow "settings"
    Then I should see "1 Bob (username pending) invited"

  Scenario: should be able to suspend and re-activate access for friend
    Given a user exists with name: "Bob", username: "testFriend1", email: "testFriend1@somewhere.com", password: "Password1"
    And an editor exists with user_id: 2, book_id: 1, status: "active"
    When I follow "settings"
    And I follow "suspend"
    Then I should see "'testFriend1' suspended"
    And I should see "1 Bob (testFriend1) suspended re-activate"
    When I follow "re-activate"
    Then I should see "'testFriend1' re-activated"
    And I should see "1 Bob (testFriend1) active suspend"

  Scenario: should not be able to suspend friends that are not mine
    Given a user exists with name: "Bob", username: "testUser2", email: "testUser2@somewhere.com", password: "Password1"
    And a book exists with owner_id: 2, plan: "medium"
    And a user exists with name: "Cal", username: "notMyFriend", email: "notMyFriend@somewhere.com", password: "Password1"
    And an editor exists with user_id: 3, book_id: 2, status: "active"
    When I go to the "suspend/3" page
    Then an editor should exist with user_id: 3, book_id: 2, status: "active"
    And I should see "You may not suspend friends that are not yours"
    But I should not see "'notMyFriend' suspended"

  Scenario: should not be able to re-activate friends that are not mine
    Given a user exists with name: "Bob", username: "testUser2", email: "testUser2@somewhere.com", password: "Password1"
    And a book exists with owner_id: 2, plan: "medium"
    And a user exists with name: "Cal", username: "notMyFriend", email: "notMyFriend@somewhere.com", password: "Password1"
    And an editor exists with user_id: 3, book_id: 2, status: "active"
    When I go to the "reactivate/3" page
    Then an editor should exist with user_id: 3, book_id: 2, status: "active"
    And I should see "You may not re-activate friends that are not yours"
    But I should not see "'notMyFriend' re-activated"

