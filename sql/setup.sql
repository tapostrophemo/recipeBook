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
  status  VARCHAR(16) DEFAULT NULL,
  PRIMARY KEY (book_id, user_id),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (book_id) REFERENCES books(id)
) engine = InnoDB;

CREATE TABLE marketing (
  id              INT(11) NOT NULL auto_increment,
  cookie_id       VARCHAR(36),
  account_id      INT(11),
  created_at      TIMESTAMP,
  updated_at      TIMESTAMP,
  referring_url   VARCHAR(255),
  landing_page    VARCHAR(255),
  PRIMARY KEY (id)
);
ALTER TABLE marketing ADD activity VARCHAR(20);
ALTER TABLE marketing
  MODIFY created_at TIMESTAMP
  DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE marketing
  MODIFY updated_at TIMESTAMP NOT NULL;

