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

  public function __construct($recipe_id = null, $user_id = null, $recipe_name = '', $instructions = '', $cooking_time = 0, $difficulty = '', $cuisine_type = '', $meal_type = '') {
    $this->recipe_id = $recipe_id;
    $this->user_id = $user_id;
    $this->recipe_name = $recipe_name;
    $this->instructions = $instructions;
    $this->cooking_time = $cooking_time;
    $this->difficulty = $difficulty;
    $this->cuisine_type = $cuisine_type;
    $this->meal_type = $meal_type;
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
