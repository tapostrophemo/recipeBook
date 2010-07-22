When /^I signup with username: "([^\"]*)", email: "([^\"]*)", password: "([^\"])*", plan: "([^\"]*)"$/ do |username, email, password, plan|
  When %{I go to the home page}
  fill_in "username", :with => username
  fill_in "email", :with => email
  fill_in "password", :with => password
  if plan != " "
    radio_button = field_by_xpath(".//input[@type='radio'][@name='plan'][@value='#{plan}']")
    radio_button.choose
  end
  click_button("signupButton")
end

# based on: http://groups.google.com/group/webrat/browse_thread/thread/d944d80073d3dbb2
When /^I choose "([^\"]*)" from "([^\"]*)"$/ do |value, field|
  radio_button = field_by_xpath(".//input[@type='radio'][@name='#{field}'][@value='#{value}']")
  radio_button.choose
end

Then /^I should see an invitation link for user: "([^"]*)"$/ do |username|
  regexp = Regexp.new(/\/acceptinvitation\/(.+)/)
  match = regexp.match(response_body)
  if match
    Then %{a user should exist with perishable_token: "#{match[1]}"}
  end
  response_body.should contain(regexp)
end

When /^I logout and "([^"]*)" accepts my invitation$/ do |username|
  token = Regexp.new(/\/acceptinvitation\/(.+)/).match(response_body)[1]
  When %{I follow "logout"}
  And %{I go to accept an invitation with token "#{token}"}
end

Given /^I add (\d+) friends to book (\d+)$/ do |num_friends, book_id|
  (1..num_friends.to_i).each do |i|
    j = i + 1
    user = User.create!({:username => "testFriend#{i}", :email => "testFriend#{i}@somewhere.com", :password => "Password#{i}"})
    Editor.create({:user_id => user.id, :book_id => book_id})

    Then %{a user should exist with username: "testFriend#{i}", email: "testFriend#{i}@somewhere.com"}
    And %{an editor should exist with user_id: #{j}, book_id: #{book_id}}
  end
end

Then /^the "([^"]*)" field for user "([^"]*)" should be today$/ do |fieldname, username|
  user = User.find_by_username(username)
  now = Time.now
  user.send(fieldname).year.should == now.year
  user.send(fieldname).month.should == now.month
  user.send(fieldname).day.should == now.day
end
