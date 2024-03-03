<?php

class Cuisine {

  static protected $table_name = 'cuisine_name';
  static protected $db_columns = ['cuisine_id', 'cuisine_name'];
  
  public $cuisine_id;
  public $cuisine_name;

  public function __construct($cuisine_id, $cuisine_name) {
      $this->cuisine_id = $cuisine_id;
      $this->cuisine_name = $cuisine_name;
  }

  public const CUISINE_OPTIONS = [
    1 => 'Italian',
    2 => 'Mexican',
    3 => 'Chinese',
    4 => 'Indian',
    5 => 'French'
  ];
}

?>
