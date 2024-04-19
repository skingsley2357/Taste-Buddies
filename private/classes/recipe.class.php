<?php

class Recipe extends DatabaseObject {

  static protected $table_name = 'recipes';
  static protected $db_columns = ['recipe_id', 'user_id', 'recipe_name', 'instructions', 'cooking_time', 'difficulty', 'cuisine_type', 'meal_type'];

  public $recipe_id;
  public $user_id;
  public $recipe_name;
  public $instructions;
  public $cooking_time;
  public $difficulty;
  public $cuisine_type;
  public $meal_type;

  public function __construct($args=[]) {
    $this->recipe_id = $args['recipe_id'] ?? '';
    $this->user_id = $args['user_id'] ?? '';
    $this->recipe_name = $args['recipe_name'] ?? '';
    $this->instructions = $args['instructions'] ?? '';
    $this->cooking_time = $args['cooking_time'] ?? '';
    $this->difficulty = $args['difficulty'] ?? '';
    $this->cuisine_type = $args['cuisine_type'] ?? '';
    $this->meal_type = $args['meal_type'] ?? '';
  }

  // public const CONSERVATION_OPTIONS = [
  //   1 => 'Low concern',
  //   2 => 'Moderate concern',
  //   3 => 'Extreme concern',
  //   4 => 'Extinct',
  // ];


  // public function conservation() {
  //   if($this->conservation_id > 0) {
  //     return self::CONSERVATION_OPTIONS[$this->conservation_id];
  //   } else {
  //     return "Unknown";
  //   }
  // }


  // protected function validate() {
  //   $this->errors = [];

  //   if(is_blank($this->common_name)) {
  //     $this->errors[] = "Bird name cannot be blank.";
  //   }
   
  //   return $this->errors;
  // }


}

?>
