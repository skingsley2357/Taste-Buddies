<?php

/**
 * Represents a MealType entity with properties and methods to manage meal type data.
 */
class MealType extends DatabaseObject {

  /**
   * The database table name associated with the MealType class.
   * @var string
   */
  static protected $table_name = 'meal_type';

  /**
   * The database columns to be used with the MealType class.
   * @var array
   */
  static protected $db_columns = ['meal_id', 'meal_type'];
  
  /**
   * The identifier for the meal type.
   * @var int
   */
  public $meal_id;

  /**
   * The name of the meal type.
   * @var string
   */
  public $meal_type;

  /**
   * Constructor for the MealType class.
   * Initializes the meal type properties.
   * @param int $meal_id - The unique identifier of the meal type.
   * @param string $meal_type - The name of the meal type.
   */
  public function __construct($meal_id, $meal_type) {
    $this->meal_id = $meal_id;
    $this->meal_type = $meal_type;
  }

  /**
   * List of meal options mapped by meal ID.
   */
  public const MEAL_OPTIONS = [
    1 => 'Breakfast',
    2 => 'Lunch',
    3 => 'Dinner',
    4 => 'Snack'
  ];

  /**
   * Retrieves the meal type name based on the meal ID.
   * Returns 'Unknown' if the meal ID does not exist in the list.
   * @return string - The name of the meal type.
   */
  public function meal() {
    if($this->meal_id > 0) {
      return self::MEAL_OPTIONS[$this->meal_id];
    } else {
      return "Unknown";
    }
  }

}

?>
