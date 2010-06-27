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

