<?php

namespace berninagray\dataDesign;
require_once("autoload.php");
require_once(dirname(__DIR__, 2). "/vendor/autoload.php");
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
	 * @param string|Uuid $newArticleId
	 * @param string|Uuid $newArticleCategoryId
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
		}
			//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/** accessor method for article id
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
	 *
	 * @return Uuid value of of article category id
	 **/
	public function getArticleCategoryId() : Uuid {
		return ($this->articleCategoryId);

		//this outside of class
	}

	/** mutator method for article category id
	 *
	 * @param Uuid|string $newArticleCategoryId
	 * @throws \RangeException if $newArticleCategoryId is not positive
	 * @throws \TypeError if $newArticleCategoryId is not a uuid or string
	 **/
	public function setArticleCategoryId( $newArticleCategoryId) : void {
		try {
			$uuid = self::validateUuid($newArticleCategoryId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		}

		//convert and store the article category id
		$this->articleCategoryIdId = $uuid;
	}
	/** accessor method for article content
	 *
	 *@return string value of article content
	 **/
	public function getArticleContent() : string {
		return($this->articleContent);
	}

	/**
	 * mutator method for article content
	 *
	 * @param string $newArticleContent new value of article content
	 * @throws \InvalidArgumentException | if $newArticleContent is not a string or insecure
	 * @throws \RangeException if $newArticleContent is > 32 characters
	 * @throws \TypeError if $newArticleContent is not a string
	 **/
	public function setArticleContent(string $newArticleContent) : void {
		//verify the tweet content is secure
		$newArticleContent = trim($newArticleContent);
		$newArticleContent = filter_var($newArticleContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if (empty($newArticleContent) === true) {
			throw(new \InvalidArgumentException("article content is empty or insecure"));
	}

		//verify the article content will fit in the database
		if(strlen($newArticleContent) >= 140) {
			throw(new \RangeException("article content too large"));
	}

		//store the article content
		$this->articleContent = $newArticleContent;
	}
	/**
	 * accessor method for article date
	 *
	 * @return \DateTime value of article date
	 **/
	public function getArticleDate() : \DateTime {
	return ($this->tweetDate);
	}

	/** mutator mthod for article content date
	 *
	 * @param \DateTime|string|null $newArticleDate article date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newArticleDate is not a valid object or string
	 * @throws \RangeException if $newArticleDate is a date that does not exist
	 **/
	public function setArticleDate($newArticleDate = null) : void {
		//base case: if the date is null, use the current date and time
		if($newArticleDate === null) {
			$this->articleDate = new \DateTime();
			return;
		}

		//store the article date using the validateDate trait
		try {
			$newArticleDate = self::validateDateTime($newArticleDate);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
	$this->articleDate = $newArticleDate;
	}
	/** PDO methods
	 *
	 * insert category name into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 * **/
	public function insert(\PDO $pdo) : void {
	//Adding a new article to the database
		$query = "INSERT INTO article(articleId, $this->articleCategoryId, $this->articleContent, articleDate, articleName)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$formattedDate = $this->articleDate->format("Y-m-d H:i:s:u");
		$parameters = ["articleId" => $formattedDate];
		$statement->execute($parameters);
	}
	/** deletes this article from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {
		//create query template
		$query = "DELETE FROM article WHERE articleId = :articleId";
		$statement->execute($parameters);
	}
	/**
	 * updates this Article in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {

		//create query template
		$query = "UPDATE article SET articleCategoryIdId = :articleCategoryID, articleContent = :articleContent, articleDate = :articleDate WHERE articleId = :articleId:";
		$statement = $pdo->prepare($query);


		$formattedDate = $pdo->prepare($query);
		$parameters = ["articleId" => $this->articleId->getBytes(), "articleCategoryId" = $this->articleCategoryId->getBytes(), "articleContent" => $this->articleContent, "articleDate" = $formattedDate];
		$statement = $pdo->prepare($query);
	}
	/** gets the article by articleId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $articleId article id top search for
	 * @return article|null article found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getArticleByArticleId(\PDO $pdo, $articleId) : ?Article {
		//sanitize the articleId before searching
		try {
			$articleId = self::validateUuid(($articleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		// create query template
		$query = "SELECT articleId, articleCategoryId, articleContent, articleDate FROM article WHERE articleId = :articleId":
		$statement = $pdo->prepare($query);

		// bind the article id to the place holder in the template
		$parameters = ["articleId" => $articleId->getBytes()];
		$statement->execute($parameters);

		// build an array of articles
		$articles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
		try {
			$article = new Article($row["articleId"], $row["articleCategoryId"], $row["articleContent"], $row["articleDate"]);
			$articles[->key()] = $article;
			$article->next();
		} catch(\Exception $exception) {
			//if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($article);

	}

	/**
	 * gets the article by content
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $articleContent article content to search for
	 * @return \SplFixedArray SplFixedArray of Articles found
	 * @throws \PDOException when mySql related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getArticleByArticleContent(\PDO $pdo, string $articleContent) : \SplFixedArray {
		// sanitize the description before searching
		$articleContent = trim($aritcleContent);
		$articleContent = filter_var($articleContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($articleContent) === true) {
			throw(new \PDOException("article content is valid"));
		}

		// escape any mySQL wild cards
			$articleContent = str_replace("_", "\\_", str_replace("%", "\\%", $articleContent));

		// create query template
		$query = "SELECT articleId, articleCategoryId, articleContent, articleDate FROM article WHERE articleContent LIKE :articleContent";
		$statement = $pdo->prepare($query);

		//bind the article content to the place holder in the template
		$articleContent = "%articleContent%";
		$parameters = ["articleContent" => $articleContent];
		$statement->execute($parameters);

		// build an array of articles
		$articles = new \SplFixedArray(($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$article = new Article($row["articleId"], $row["articleCategoryId"], $row["articleContent"], $row["articleDate"]);
				$articles[$articles->key()] = $article;
				$articles->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($articles);
}
		/**
		 * gets all Articles
		 *
		 * @param \PDO $pdo PDO connection object
		 * @returnm\SplFixedArray of Articles found or null if not found
		 * @throws \PDOException when mySQL related errors occur
		 * @throws \TypeError when variables are not the correct data type
		 **/
		public static function getAllArticles(\PDO $pdo) : \SplFixedArray {
			// create query template
			$query = "SELECT articleId, articleCategoryId, articleContent, articleDate FROM article";
			$statement = $pdo->prepare($query);
			while(($row = $statement->fetch()) !== false) {
				try {
					$article = new Article($row["articleId"], $row["articleCategoryId"])
				}
			}
		}
		}
}


