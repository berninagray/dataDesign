INSERT INTO category (categoryId, categoryName) VALUES (unhex(92ede112a7d34c988830be9b480701a8), "Politics");

UPDATE category set categoryName = "Politics" where categoryId = unhex("92ede112a7d34c988830be9b480701a8");

DELETE from category where CategoryId = unhex("92ede112a7d34c988830be9b480701a8");

SELECT categoryId, categoryName where = unhex("92ede112a7d34c988830be9b480701a8");

SELECT categoryId, categoryName where = categoryName = "Politics";

SELECT * from category;

SELECT categoryId, categoryName, from category where categoryName = unhex("92ede112a7d34c988830be9b480701a8") > min;

/*Inner Joins SELECT from category*/
SELECT
