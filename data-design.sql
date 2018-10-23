DROP TABLE IF EXISTS category;
DROP TABLE IF EXISTS article;

create table category(
	categoryId binary(16) not null,
	categoryName varchar(32) not null
);

create table article(
	articleId binary (16) not null,
	articleCategoryId varchar (255),
	articleContent varchar (8192),
	articleDate varchar (128) not null,
	articleName char(97) not null
);


