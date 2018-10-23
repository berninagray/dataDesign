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

	/**
	 * constructor for this article
	 *
	 * article constructor.
	 * @param Uuid $newArticleId
	 * @param Uuid $newArticleCategoryId
	 * @param string $newArticleContent
	 * @param \DateTime|string|null $newArticleDate date and time article was published or null if set to current date and time
	 * @param string $newArticleName
	 * @throws \RangeException if data values are out of bounds (e.g., strings are too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct(Uuid $newArticleId, Uuid $newArticleCategoryId, string $newArticleContent, $newArticleDate = null, string $newArticleName, $exceptionType) {
		try {
			$this->setArticleId($newArticleId);
			$this->setArticleCategoryId($newArticleCategoryId);
			$this->setArticleContent($newArticleContent);
			$this->setArticleDate($newArticleDate);
			$this->setArticleName($newArticleName);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exception = get_class($exception);
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/** accesor method for article id
	 *
	 * @return Uuid value of article id
	 **/
	public function getArticleId() : Uuid {
		return($this->articleId);

		//this outside of class
		//$tweet->getTweetId();
	}

	/**
	 * mutator method for article id
	 *
	 * @param Uuid|string $newArticleId new value of article id
	 * @throws \RangeException if $newArticleId is not positive
	**/
	public function setArticleId( $newArticleId) : void {
		try {
			$uuid = self::validateUuid($newArticleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {

		}

		//convert and store the article id
		$this->articleId = $uuid;
	}
	/**
	 * accessor method for article category id
	 */
}

