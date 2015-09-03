use pafdb;


create table if not exists FRUIT
(
	ID 		int,
	NAME 	TEXT,
	COLOUR 	TEXT
);

show tables;

explain FRUIT;

drop table if exists FRUIT;

show tables;

create table if not exists PRODUCT
(
	ID 			int unique auto_increment,
	MYKEY		int unique primary key,
	CODE 		int	not null,
	NAME		varchar(25) not null,
	QUANTITY 	int default 1 null,
	PRICE		decimal (6,2) not null,
	ATIME		timestamp
);

explain PRODUCT;

alter table PRODUCT
	add column PLOP varchar(30),
	change NAME NEW_NAME varchar(25),
	drop column ID;

explain PRODUCT;
	
drop table if exists PRODUCT;