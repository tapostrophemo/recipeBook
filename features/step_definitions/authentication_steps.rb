Given /^I (?:am logged in|login) with username: "([^\"]*)", password: "([^\"]*)"$/ do |username, password|
  When %{I am on the home page}
  And %{I follow "login"}
  fill_in "username", :with => username
  fill_in "password", :with => password
  click_button("Login")
end

Then /^I should be logged in/ do
  Then %{I should see "logout"}
  But %{I should not see "login"}
end

Then /^I should not be logged in/ do
  Then %{I should see "login"}
  But %{I should not see "logout"}
end

Given /^I am logged in with admin username: "([^"]*)", password: "([^"]*)"$/ do |username, password|
  Given %{I go to the admin page}
  fill_in "username", :with => username
  fill_in "password", :with => password
  click_button("Login")
end
