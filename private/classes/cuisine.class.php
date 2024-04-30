<?php

/**
 * Represents a Cuisine entity with properties and methods to manage cuisine data.
 */
class Cuisine extends DatabaseObject {

  /**
   * The database table name associated with the Cuisine class.
   * @var string
   */
  static protected $table_name = 'cuisine_name';

  /**
   * The database columns to be used with the Cuisine class.
   * @var array
   */
  static protected $db_columns = ['cuisine_id', 'cuisine_name'];
  
  /**
   * The identifier for the cuisine.
   * @var int
   */
  public $cuisine_id;

  /**
   * The name of the cuisine.
   * @var string
   */
  public $cuisine_name;

  /**
   * Constructor for the Cuisine class.
   * @param int $cuisine_id - The unique identifier of the cuisine.
   * @param string $cuisine_name - The name of the cuisine.
   */
  public function __construct($cuisine_id, $cuisine_name) {
      $this->cuisine_id = $cuisine_id;
      $this->cuisine_name = $cuisine_name;
  }

  /**
   * List of cuisine options mapped by cuisine ID.
   */
  public const CUISINE_OPTIONS = [
    1 => 'Italian',
    2 => 'Mexican',
    3 => 'Chinese',
    4 => 'Indian',
    5 => 'French'
  ];

  /**
   * Retrieves the cuisine name based on the cuisine ID.
   * Returns 'Unknown' if the cuisine ID does not exist in the list.
   * @return string - The name of the cuisine.
   */
  public function cuisine() {
    if($this->cuisine_id > 0) {
      return self::CUISINE_OPTIONS[$this->cuisine_id];
    } else {
      return "Unknown";
    }
  }

}

?>
