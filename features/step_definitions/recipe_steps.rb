Given /I add (\d+) recipes to book (\d+)/ do |num_recipes, book_id|
  # TODO: optimize this (sim. to add friends stuff)
  (1..num_recipes.to_i).each do |i|
    When %{I go to the table of contents page}
    And %{I follow "add recipe"}
    And %{I fill in "name" with "recipe #{i}"}
    And %{I press "Save"}
    Then %{I should see "Recipe created"}
    And %{a recipe should exist with name: "recipe #{i}", book_id: #{book_id}}
  end
end
