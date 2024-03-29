<?php

class Ingredients extends DatabaseObject {

  static protected $table_name = 'ingredients';
  static protected $db_columns = ['ingredient_id','recipe_id',  'ingredient_name', 'measurement_type', 'measurement_num'];

  public $ingredient_id;
  public $recipe_id;
  public $ingredient_name;
  public $measurement_type;
  public $measurement_num;

  public function __construct($ingredient_id = null, $recipe_id = null, $ingredient_name = null, $measurement_type = null, $measurement_num = null) {
    $this->ingredient_id = $ingredient_id;
    $this->recipe_id = $recipe_id;
    $this->ingredient_name = $ingredient_name;
    $this->measurement_type = $measurement_type;
    $this->measurement_num = $measurement_num;
  }

}

?>
