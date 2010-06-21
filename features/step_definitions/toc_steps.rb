Then /^I should see the following categories and recipes$/ do |table|
  table.hashes.each do |hash|
    Then %{I should see "#{hash['Category']} #{hash['Recipe']}"}
  end
end

Then /^I should have (\d+) recipes in book: (\d+)$/ do |num, book_id|
  Book.find_by_id(book_id.to_i).recipes.size.should == num.to_i
end
