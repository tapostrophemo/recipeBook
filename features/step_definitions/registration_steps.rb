When /^I signup with username: "([^\"]*)", email: "([^\"]*)"$/ do |username, email|
  When %{I go to the home page}
  fill_in "username", :with => username
  fill_in "email", :with => email
  click_button("signupButton")
end

# based on: http://groups.google.com/group/webrat/browse_thread/thread/d944d80073d3dbb2
When /^I choose "([^\"]*)" from "([^\"]*)"$/ do |value, field|
  radio_button = field_by_xpath(".//input[@type='radio'][@name='#{field}'][@value='#{value}']")
  radio_button.choose
end
