Given /I add (\d+) recipes to book (\d+)/ do |num_recipes, book_id|
  (1..num_recipes.to_i).each do |i|
    Recipe.create!({:name => "Recipe #{i}", :book_id => book_id})

    Then %{a recipe should exist with name: "recipe #{i}", book_id: #{book_id}}
  end
end
