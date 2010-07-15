CREATE TABLE admin_users (
  id                INT(11) NOT NULL auto_increment,
  username          VARCHAR(255) CHARACTER SET utf8 NOT NULL,
  crypted_password  VARCHAR(255) NOT NULL,
  password_salt     VARCHAR(255) NOT NULL,
  persistence_token VARCHAR(255) NOT NULL,
  perishable_token  VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY username (username)
);

