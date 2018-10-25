INSERT INTO category (categoryId, categoryName) VALUES (unhex(92ede112a7d34c988830be9b480701a8), "Corporations");

UPDATE category set categoryName = "Politics" where categoryId = unhex("92ede112a7d34c988830be9b480701a8");

DELETE from category where CategoryId = unhex("92ede112a7d34c988830be9b480701a8");

SELECT categoryId, categoryName where = unhex("92ede112a7d34c988830be9b480701a8");

SELECT categoryId, categoryName where = categoryName = "Corporations";

SELECT * from category;

SELECT categoryId, categoryName, from category where categoryName = unhex("92ede112a7d34c988830be9b480701a8") > min;

/*Inner Joins SELECT from article*/

SELECT article.articleId, article.articleCategoryId, article.articleContent, article.articleDate, article.articleName,
category.categoryName from article innerjoin category on article.articleCategoryId = category.categoryId where articleId = uuid /*placeholder for articleId - generate one first*/

/*Article insert, update, delete and select tables begin*/

INSERT INTO article (articleID, articleCategoryId, articleContent, articleDate, articleName) VALUES (unhex(17c05a2ed14b44129c91536b81f94c2f) "");

/*Insert with Foreign Keys*/

INSERT INTO article(articleId, articleCategoryId, articleContent, articleDate, articleName) VALUES (unhex("17c05a2ed14b44129c91536b81f94c2f"), (unhex("92ede112a7d34c988830be9b480701a8"))


UPDATE

