CREATE DATABASE finance;

USE finance;

CREATE TABLE account_type(
	id INT NOT NULL AUTO_INCREMENT,
	name CHAR(128) NOT NULL,
	PRIMARY KEY(id)
);


CREATE TABLE accounts(
	id INT NOT NULL AUTO_INCREMENT,
	name CHAR(128) DEFAULT NULL,
	type INT DEFAULT NULL,
	balance  DECIMAL DEFAULT NULL,
	describ TEXT DEFAULT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE budgets(
	id INT NOT NULL AUTO_INCREMENT,
	user_id INT  DEFAULT NULL,
	name CHAR(128) DEFAULT NULL,
	amount  DECIMAL DEFAULT NULL,
	describ TEXT DEFAULT NULL,
	year INT DEFAULT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE items(
	id INT NOT NULL AUTO_INCREMENT,
	name CHAR(128) DEFAULT NULL,
	amount  DECIMAL DEFAULT NULL,
	budget_id INT DEFAULT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE transactions(
	id INT NOT NULL AUTO_INCREMENT,
	name CHAR(128) DEFAULT NULL,
	amount  DECIMAL DEFAULT NULL,
	description TEXT DEFAULT NULL,
	datee DATE DEFAULT NULL,
	type INT DEFAULT NULL,
	account INT DEFAULT NULL,
	PRIMARY KEY(id)
);



CREATE TABLE user_group(
	id INT NOT NULL AUTO_INCREMENT,
	name CHAR(128) DEFAULT NULL,
	PRIMARY KEY(id)
);



CREATE TABLE years(
	id INT NOT NULL AUTO_INCREMENT,
	name CHAR(128) DEFAULT NULL,
	date_begin DATE DEFAULT NULL,
	date_end DATE DEFAULT NULL,
	PRIMARY KEY(id)
);


INSERT INTO finance.users(name,email,password,group_id) VALUES('Nelson','nelson@gmail.com','Password1','1');
INSERT INTO finance.users(name,email,password,group_id) VALUES('Mozart','jimmy@gmail.com','Password1','1');
INSERT INTO finance.users(name,email,password,group_id) VALUES('Linkages','neek@gmail.com','Password1','1');