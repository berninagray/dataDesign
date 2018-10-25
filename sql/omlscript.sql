INSERT INTO category (categoryId, categoryName) VALUES (unhex(92ede112a7d34c988830be9b480701a8), "Corporations");
INSERT INTO article (articleID, articleCategoryId, articleContent, articleDate, articleName) VALUES (unhex(17c05a2ed14b44129c91536b81f94c2f);

UPDATE category set categoryName = "Politics" where categoryId = unhex("92ede112a7d34c988830be9b480701a8");

DELETE from category where categoryName = "corporations";

SELECT categoryId, categoryName from category where categoryId = unhex("92ede112a7d34c988830be9b480701a8");

/*Inner Joins SELECT from article*/

SELECT article.articleId, article.articleCategoryId, article.articleContent, article.articleDate, article.articleName,
category.categoryId from article inner join category on article.CategoryId = category.categoryId where articleId = (unhex(17c05a2ed14b44129c91536b81f94c2f);

/*Article insert, update, delete and select tables begin*/


