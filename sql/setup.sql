CREATE TABLE recipes (
  id           INT(11) NOT NULL auto_increment,
  category     TINYINT NOT NULL DEFAULT 1,
  name         VARCHAR(255) NOT NULL,
  photo        VARCHAR(255) DEFAULT NULL,
  ingredients  TEXT DEFAULT NULL,
  instructions TEXT DEFAULT NULL,
  PRIMARY KEY  (id)
);

CREATE TABLE users (
  id                INT(11) NOT NULL auto_increment,
  username          VARCHAR(255) CHARACTER SET utf8 NOT NULL,
  email             VARCHAR(255) NOT NULL,
  crypted_password  VARCHAR(255) NOT NULL,
  password_salt     VARCHAR(255) NOT NULL,
  persistence_token VARCHAR(255) NOT NULL,
  perishable_token  VARCHAR(255) NOT NULL,
  is_admin BOOLEAN DEFAULT FALSE,
  PRIMARY KEY (id),
  UNIQUE KEY email (email),
  UNIQUE KEY username (username)
);

