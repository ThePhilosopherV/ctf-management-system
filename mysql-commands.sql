CREATE DATABASE cyber;

USE cyber;

-- users table
CREATE TABLE users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  pass_md5 VARCHAR(255) NOT NULL,
  `rank` INT(11) NOT NULL DEFAULT 0,
  points INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
);

-- CTFs done for all users

CREATE TABLE ctf_done (
  user_id INT(11) NOT NULL,
  ctf_name VARCHAR(255) NOT NULL,
  date_completed TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (user_id, ctf_name),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (ctf_name) REFERENCES ctfs(ctf_name) ON DELETE CASCADE
);

-- CTFs flags

CREATE TABLE ctfs (
  -- ctf_id INT(11) NOT NULL AUTO_INCREMENT,
  ctf_name VARCHAR(255) PRIMARY KEY,
  ctf_flag VARCHAR(255) NOT NULL,
  ctf_points  INT(11) NOT NULL DEFAULT 0,

);
ALTER TABLE ctfs ADD COLUMN url VARCHAR(255);





-- an example of adding a ctf:



INSERT INTO ctfs (ctf_name, ctf_flag,ctf_points,url ) 
VALUES ('ctf1','very_secret_flag',100,'ctfs/bruteverse.zip');





