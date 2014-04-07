CREATE TABLE person (
 username VARCHAR(255) NOT NULL PRIMARY KEY,
 rank INT(11) NOT NULL UNIQUE,
 iconpath VARCHAR(255) DEFAULT ''
);




CREATE TABLE task (
 id INT(11) AUTO_INCREMENT PRIMARY KEY,
 personid VARCHAR(255) NOT NULL,
 date DATE NOT NULL,
 content VARCHAR(255) NOT NULL
);


CREATE TABLE holidays (
 date DATE NOT NULL PRIMARY KEY,
 description VARCHAR(32) DEFAULT '$B=K(B'
);