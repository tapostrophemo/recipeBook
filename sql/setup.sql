CREATE TABLE recipes (
  id           INT(11) NOT NULL auto_increment,
  name         VARCHAR(255) NOT NULL,
  photo        VARCHAR(255) DEFAULT NULL,
  ingredients  TEXT DEFAULT NULL,
  instructions TEXT DEFAULT NULL,
  PRIMARY KEY  (id)
);

