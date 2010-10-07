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

And /^I login to PayPal as a buyer$/ do
debugger
  webrat.request_page(webrat.redirected_to, :get, {}) # PayPal sandbox wants us to login first; need cookies?
  fill_in "login_email", :with => @@paypal_buyer_email
  fill_in "login_password", :with => @@paypal_buyer_password
  click_button("Log In")
end

Then /^I should be able to change my password$/ do
  assert_have_xpath("//form[contains(@action, '/newpass')]")
end

Then /^I should have the following controls:$/ do |controls|
  links = []
  webrat.dom.xpath("//ul[@id='controls']//a").each do |link|
    links << [link.text]
  end
  controls.diff!(links)
end
