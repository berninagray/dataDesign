<?php
namespace berninagray\dataDesign;
require_once(dirname(__DIR__, 2). "/vendor/autoload.php");
require_once(dirname(__DIR__, 2). "/classes/article.php");
$newArticle = new article("17c05a2e-d14b-4412-9c91-536b81f94c2f", "92ede112-a7d3-4c98-8830-be9b480701a8", "foobar", "current date", "foobar");

var_dump($newArticle);