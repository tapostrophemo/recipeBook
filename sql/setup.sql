CREATE TABLE users (
  id                INT(11) NOT NULL auto_increment,
  username          VARCHAR(255) CHARACTER SET utf8 NOT NULL,
  email             VARCHAR(255) NOT NULL,
  crypted_password  VARCHAR(255) NOT NULL,
  password_salt     VARCHAR(255) NOT NULL,
  persistence_token VARCHAR(255) NOT NULL,
  perishable_token  VARCHAR(255) NOT NULL,
  created_at        DATETIME NOT NULL,
  last_login_at     DATETIME DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY email (email),
  UNIQUE KEY username (username)
) engine = InnoDB;

CREATE TABLE books (
  id       INT(11) NOT NULL auto_increment,
  owner_id INT(11) NOT NULL,
  plan     CHAR(16) NOT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (owner_id) REFERENCES users(id)
) engine = InnoDB;

CREATE TABLE recipes (
  id           INT(11) NOT NULL auto_increment,
  book_id      INT(11) NOT NULL,
  category     TINYINT NOT NULL DEFAULT 1,
  name         VARCHAR(255) NOT NULL,
  photo        VARCHAR(255) DEFAULT NULL,
  ingredients  TEXT DEFAULT NULL,
  instructions TEXT DEFAULT NULL,
  PRIMARY KEY  (id),
  FOREIGN KEY (book_id) REFERENCES books(id)
) engine = InnoDB;

CREATE TABLE editors (
  user_id INT(11) NOT NULL,
  book_id INT(11) NOT NULL,
  PRIMARY KEY (book_id, user_id),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (book_id) REFERENCES books(id)
) engine = InnoDB;

