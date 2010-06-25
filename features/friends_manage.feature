@wip
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
    And an editor exists with user_id: 2, book_id: 1, status: "accepted"
    When I follow "manage"
    Then I should see "1 testFriend1 accepted"

