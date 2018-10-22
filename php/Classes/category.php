<?php

namespace berninagray\dataDesign;
require_once("autoload.php");
require_once(dirname(__DIR__,2). "/vendor/autoload.php");
use Ramsey\Uuid\Uuid;


/**
 *Category is my top level entity that holds the keys to the article entity.
 *
 * @author Bernina Gray <bgray11@cnm.edu
 *
 **/

class category {
	use ValidateUuid;
	/**
	 * id for categoryId; this is the primary key
	 * @var Uuid $categoryId
	**/
	private $categoryId;

	/**
	 * name for category;
	 *@var string $categoryName
	 **/
	private $categoryName;

	/**
	 * constructor for this category
	 *category constructor.
	 * @param Uuid $newCategoryId
	 * @param string $categoryName
	 */
	public function __construct(Uuid $newCategoryId, string $newCategoryName) {
		try{
			$this->setCategoryId($newCategoryId);
			$this->setCategoryName($newCategoryName);
		} catch (\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception){
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for category id
	 *
	 * @return Uuid value of category id
	 *
	 **/
	public function getCategoryId() : Uuid {
		return($this->categoryId);
	}
	/**
	 * mutator method for category id
	 *
	 * @param Uuid| string $newCategoryId value of new category id
	 * @throws \rangeException if $newCategoryId is not positive
	 * @throws \TypeError if category is not a Uuid
	 **/
	public function setCategoryId($newCategoryId) : void {
		try {
			$Uuid = self::validateUuid(newCategoryId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//convert and store the category id
		$this->categoryId = $Uuid;
	}

	/**
	 * accessor for category name
	 * @return string value of category name
	 **/
	public function getCategoryName(): string {
		return $this->categoryName;
	}
	/**
	 * mutator method for category name
	 * @param string $newCategoryName new value of category name
	 * @throws \InvalidArgumentException if $newCategoryName is not a string or insecure
	 * @throws \RangeException if $newCategoryName is > 32 characters
	 * @throws \TypeError if $newCategoryName is not a string
	 **/
	public function setCategoryName(string $newCategoryName): void {
		//verify the author name is secure
		$newCategoryName = trim($newCategoryName);
		$newCategoryName = filter_var($newCategoryName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if (empty($newCategoryName) === true) {
			throw(new \InvalidArgumentException("category name is empty or insecure"));
		}

		//verify the category name content will fit in the database
		if(strlen($newCategoryName)>32) {
			throw(new \RangeException("category name is too long"));
		}
		//store the category name
		$this->categoryName = $newCategoryName;
	}
}