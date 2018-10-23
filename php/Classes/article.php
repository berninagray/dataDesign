<?php

namespace berninagray\dataDesign;
require_once("autoload.php");
require_once(dirname(__DIR__, .2). "/vendor/autoload.php");
use Ramsey\Uuid\Uuid;

/**
 * Category is my second level entity that holds one primary key and a foreign key.
 *
 * @author Bernina Gray <bgray11@cnm.edu>
 *
 **/

class article {
	use ValidateUuid;
	/**
	*
	* id for articleId; this is the primary key
	* @var Uuid $articleId
	**/
	private $articleId;

	/**
	 * id for articleCategoryId; this is the foreign key
	 * @var Uuid $articleCategoryId
	 **/
	private $articleCategoryId;

	/**
	 * id for articleContent;
	 * @var Uuid $articleContent
	 **/
	private $articleContent;

	/**
	 * id for articleDate;
	 * @var Uuid $articleDate
	 **/
	private $articleDate;

	/**
	 * id for articleName;
	 * @var Uuid $articleName
	 **/
	private $articleName;
}

