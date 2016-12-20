#Budgetri

Simple Budget Management System (no frameworks)

##Introduction
Budgetri is a simple budget management system meant to imitate that of a local goverment budget system.
It implements a budget tracking. the systems has 4 tiers,
* Accounts
* Transactions
* Budget Years
* Budget Items

The accounts keep track of money inputs and changes in value, and value chages with each transaction performed based on the transaction's type
income or expense, Items on the budget year are being ticked off based on the transactions.

Note: transactions can be performed on accounts without them being listed in the budget.

#Installation
In the Terminal, navigate to the Projects config folder and run the source command through mysql on the
file finance.sql

this would create a finance database with the following attributes.....

```sql
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

```


Step2:
run  $ composer dump-autoload -o  Through the terminal to run composer and
generate PSR-4 autoload namespaces for the application name spaces to navigate...

