ALTER TABLE marketing ADD invitee_id INT(11);
ALTER TABLE marketing DROP updated_at;

ALTER TABLE users ADD name VARCHAR(255) NOT NULL;

