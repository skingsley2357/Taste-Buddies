<?php

class MealType extends DatabaseObject {

  static protected $table_name = 'meal_type';
  static protected $db_columns = ['meal_id', 'meal_type'];
  
  public $meal_id;
  public $meal_type;

  public function __construct($meal_id, $meal_type) {
    $this->meal_id = $meal_id;
    $this->meal_type = $meal_type;
  }

  public const MEAL_OPTIONS = [
    1 => 'Breakfast',
    2 => 'Lunch',
    3 => 'Dinner',
    4 => 'Snack'
  ];

  public function meal() {
    if($this->meal_id > 0) {
      return self::MEAL_OPTIONS[$this->meal_id];
    } else {
      return "Unknown";
    }
  }

}

?>
