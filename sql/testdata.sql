-- first user/owner
insert into users(username, email, crypted_password, password_salt)
  values('asdf', 'asdf@asdf.com', sha1('asdfasdfabc123'), 'abc123');

insert into books(owner_id) values(1);

insert into recipes(book_id, name, category, photo, ingredients, instructions) values(1, 'Eggplant Parmesan', 1, 'res/0517102209_cropped.jpg',
'2 medium eggplants
salt
flour
olive oil
1 small onion, chopped
1 medium can tomatoes
fresh basil, chopped
1/2 C grated mozzarella cheese
Parmesan cheese',
'Wash eggplant, remove the stems, cut into 1/2\" slices, lay them flat and sprinke with salt. Let stand for 20 minutes to an hour to make the eggplant tender and remove bitterness.
Rinse the salt off the eggplant slices and pat dry. Flour the slices and fry in very hot olive oil. Brown slices on both sides then set aside to drain on a paper towel.
Pre-heat oven to 375&deg; F (190&deg; C). Brown the onion in olive oil over low heat. Add canned tomatoes, stir, and let simmer for about 15-20 minutes, stirring frequently. Add basil and salt to taste.
Arrange a layer of the fried, sliced eggplant in a baking dish. Spread several spoonfuls of tomato sauce over them. Add a layer mozzarella, and sprinkle with Parmesan cheese. Repeat in layers with the remaining ingredients.
Bake in pre-heated oven for about 20 minutes. Serve over pasta, sprinkled with Parmesan cheese.');

-- first book has one additional editor

insert into users(username, email, crypted_password, password_salt)
  values('jkl;', 'jkl@semicolon.com', sha1('asdfasdfxyzpdq'), 'xyzpdq');

insert into editors(user_id, book_id) values(2, 1);


-- second user/owner/book/editor combo (but no recipes yet)
insert into users(username, email, crypted_password, password_salt)
  values('testUser3', 'testUser3@somewhere.com', sha1('Password3abc123'), 'abc123');

insert into books(owner_id) values(3);

insert into users(username, email, crypted_password, password_salt)
  values('testUser4', 'testUser4@somewhere.com', sha1('Password4abc123'), 'abc123');

insert into editors(user_id, book_id) values(4, 2);

