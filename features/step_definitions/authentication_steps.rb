Given /^I am logged in with username: "([^\"]*)", password: "([^\"]*)"$/ do |username, password|
  When %{I am on the home page}
  And %{I follow "login"}
  fill_in "username", :with => username
  fill_in "password", :with => password
  click_button("Login")
end
