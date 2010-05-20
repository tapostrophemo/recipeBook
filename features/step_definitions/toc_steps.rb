Then /^I should see the following categories and recipes$/ do |table|
  table.hashes.each do |hash|
    Then %{I should see "#{hash['Category']} #{hash['Recipe']}"}
  end
end
