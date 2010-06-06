Then /^I should see the following users$/ do |table|
  table.hashes.each do |hash|
    Then %{I should see "#{hash['Username']} #{hash['Email']}"}
  end
end
