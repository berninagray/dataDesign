DROP TABLE IF EXISTS category;
DROP TABLE IF EXISTS article;

create table category(
	categoryId binary(16) not null,
	castegoryName varchar(32) not null
);

create table article(
	articleId binary (16) not null,
	articleCategoryId varchar (255),
	articleContent char (32),
	articleDate varchar (128) not null,
	articleName char(97) not null
);


