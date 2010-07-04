@wip
Feature: Allow different levels of functionality for different user plans
  As an owner of this site
  I want to provide different plans for my customers
  So that I may charge customers different rates according to their needs and willingness to pay

  Background:
    Given a user exists with username: "testUser1", email: "testUser1@somewhere.com", password: "Password1"

# TODO: limit recipes

#  Scenario: free/small plan is limited to 10 recipes
#    Given a book exists with owner_id: 1, plan: "free"
#    And I am logged in with username: "testUser1", password: "Password1"

  Scenario: free/small plan is limited to 1 friend
    Given a book exists with owner_id: 1, plan: "free"
    And I am logged in with username: "testUser1", password: "Password1"
    And I follow "manage"
    When I follow "invite friend"
    And I fill in "username" with "testFriend1"
    And I fill in "email" with "testFriend1@somewhere.com"
    And I press "Send Invitation"
    Then a user should exist with username: "testFriend1", email: "testFriend1@somewhere.com"
    And an editor should exist with user_id: 2, book_id: 1
    When I follow "manage"
    And I follow "invite friend"
    And I fill in "username" with "testFriend2"
    And I fill in "email" with "testFriend2@somewhere.com"
    And I press "Send Invitation"
    Then I should see "Your account is limited to 1 friend(s)"
    And a user should not exist with username: "testFriend2"
    And an editor should not exist with user_id: 3, book_id: 1

#  Scenario: medium/paid plan is limited to 100 recipes
#    Given a book exists with owner_id: 1, plan: "medium"
#    And I am logged in with username: "testUser1", password: "Password1"

  Scenario: medium/paid plan is limited to 10 friends
    Given a book exists with owner_id: 1, plan: "medium"
    And I am logged in with username: "testUser1", password: "Password1"
    And I add 10 friends to book 1
    When I follow "manage"
    And I follow "invite friend"
    And I fill in "username" with "testFriend11"
    And I fill in "email" with "testFriend11@somewhere.com"
    And I press "Send Invitation"
    Then I should see "Your account is limited to 10 friend(s)"
    And a user should not exist with username: "testFriend11"
    And an editor should not exist with user_id: 12, book_id: 1

#  Scenario: large/paid plan has unlimited recipes
#    Given a book exists with owner_id: 1, plan: "large"
#    And I am logged in with username: "testUser1", password: "Password1"

  Scenario: large/paid plan is allowed more that 100 friends
    Given a book exists with owner_id: 1, plan: "large"
    And I am logged in with username: "testUser1", password: "Password1"
    And I add 100 friends to book 1
    When I follow "manage"
    And I follow "invite friend"
    And I fill in "username" with "testFriend101"
    And I fill in "email" with "testFriend101@somewhere.com"
    And I press "Send Invitation"
    Then I should see "An invitation was sent to testFriend101@somewhere.com"
    And a user should exist with username: "testFriend101"
    And an editor should exist with user_id: 102, book_id: 1
    But I should not see "Your account is limited to unlimited friend(s)"

