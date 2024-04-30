<?php

/**
 * Represents a Difficulty entity with properties and methods to manage difficulty data.
 */
class Difficulty extends DatabaseObject {

  /**
   * The database table name associated with the Difficulty class.
   * @var string
   */
  static protected $table_name = 'difficulty';

  /**
   * The database columns to be used with the Difficulty class.
   * @var array
   */
  static protected $db_columns = ['difficulty_id', 'difficulty_name'];
  
  /**
   * The identifier for the difficulty level.
   * @var int
   */
  public $difficulty_id;

  /**
   * The name of the difficulty level.
   * @var string
   */
  public $difficulty_name;

  /**
   * Constructor for the Difficulty class.
   * @param int $difficulty_id - The unique identifier of the difficulty level.
   * @param string $difficulty_name - The name of the difficulty level.
   */
  public function __construct($difficulty_id, $difficulty_name) {
      $this->difficulty_id = $difficulty_id;
      $this->difficulty_name = $difficulty_name;
  }

  /**
   * List of difficulty level options mapped by difficulty ID.
   */
  public const DIFFICULTY_OPTIONS = [
    1 => 'Easy',
    2 => 'Medium',
    3 => 'Hard'
  ];

  /**
   * Retrieves the difficulty level name based on the difficulty ID.
   * Returns 'Unknown' if the difficulty ID does not exist in the list.
   * @return string - The name of the difficulty level.
   */
  public function difficulty() {
    if($this->difficulty_id > 0) {
      return self::DIFFICULTY_OPTIONS[$this->difficulty_id];
    } else {
      return "Unknown";
    }
  }

}

?>
