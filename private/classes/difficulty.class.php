<?php

class Difficulty extends DatabaseObjects{

  static protected $table_name = 'difficulty';
  static protected $db_columns = ['difficulty_id', 'difficulty_name'];
  
  public $difficulty_id;
  public $difficulty_name;

  public function __construct($difficulty_id, $difficulty_name) {
      $this->difficulty_id = $difficulty_id;
      $this->difficulty_name = $difficulty_name;
  }

  public const DIFFICULTY_OPTIONS = [
    1 => 'Easy',
    2 => 'Medium',
    3 => 'Hard'
  ];


  public function difficulty() {
    if($this->difficulty_id > 0) {
      return self::difficulty_OPTIONS[$this->difficulty_id];
    } else {
      return "Unknown";
    }
  }
}

?>
