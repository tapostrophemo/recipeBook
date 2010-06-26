Feature: Add friends, family or other users to your cookbook
  As a paying subscriber to the site
  I want to allow friends and family to edit my cookbook

  Background:
    Given a user exists with username: "testUser1", email: "testUser1@somewhere.com", password: "Password1"
    And a book exists with owner_id: 1, plan: "medium"
    And I am logged in with username: "testUser1", password: "Password1"

  Scenario: add a friend to my cookbook
    When I follow "manage"
    Then I should see "1"
    And I should see "2"
    And I should see "10"
    When I follow "Invite friend?"
    And I fill in "username" with "testFriend1"
    And I fill in "email" with "testFriend1@somewhere.com"
    And I press "Send Invitation"
    Then I should see "An invitation was sent to testFriend1@somewhere.com"
    And a user should exist with username: "testFriend1"
    And an editor should exist with user_id: 2, book_id: 1, status: "invited"
    # TODO: send email, redirect/refresh screen, etc.

  Scenario: see my friends
    Given a user exists with username: "testFriend1", email: "testFriend1@somewhere.com", password: "Password1"
    And an editor exists with user_id: 2, book_id: 1, status: "active"
    When I follow "manage"
    Then I should see "1 testFriend1 active"

  Scenario: should be able to suspend and re-activate access for friend
    Given a user exists with username: "testFriend1", email: "testFriend1@somewhere.com", password: "Password1"
    And an editor exists with user_id: 2, book_id: 1, status: "active"
    When I follow "manage"
    And I follow "suspend"
    Then I should see "'testFriend1' suspended"
    And I should see "1 testFriend1 suspended re-activate"
    When I follow "re-activate"
    Then I should see "'testFriend1' re-activated"
    And I should see "1 testFriend1 active suspend"

  Scenario: should not be able to suspend friends that are not mine
    Given a user exists with username: "testUser2", email: "testUser2@somewhere.com", password: "Password1"
    And a book exists with owner_id: 2, plan: "medium"
    And a user exists with username: "notMyFriend", email: "notMyFriend@somewhere.com", password: "Password1"
    And an editor exists with user_id: 3, book_id: 2, status: "active"
    When I go to the "suspend/3" page
    Then an editor should exist with user_id: 3, book_id: 2, status: "active"
    And I should see "You may not suspend friends that are not yours"
    But I should not see "'notMyFriend' suspended"

  Scenario: should not be able to re-activate friends that are not mine
    Given a user exists with username: "testUser2", email: "testUser2@somewhere.com", password: "Password1"
    And a book exists with owner_id: 2, plan: "medium"
    And a user exists with username: "notMyFriend", email: "notMyFriend@somewhere.com", password: "Password1"
    And an editor exists with user_id: 3, book_id: 2, status: "active"
    When I go to the "reactivate/3" page
    Then an editor should exist with user_id: 3, book_id: 2, status: "active"
    And I should see "You may not re-activate friends that are not yours"
    But I should not see "'notMyFriend' re-activated"

