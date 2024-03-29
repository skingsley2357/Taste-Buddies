<?php

class MeasurementType {

  static protected $table_name = 'measurement_type';
  static protected $db_columns = ['measurement_id', 'measurement'];

  public $measurement_id;
  public $measurement;

  public function __construct($measurement_id, $measurement) {
    $this->measurement_id = $measurement_id;
    $this->measurement = $measurement;
  }

  public const MEASUREMENT_TYPE = [
    1 => 'Teaspoon (tsp)',
    2 => 'Tablespoon (tbsp)',
    3 => 'Fluid ounce (fl oz)',
    4 => 'Cup (c)',
    5 => 'Pint (pt)',
    6 => 'Quart (qt)',
    7 => 'Gallon (gal)',
    8 => 'Milliliter (ml)',
    9 => 'Liter (L)',
    10 => 'Ounce (oz)',
    11 => 'Pound (lb)',
    12 => 'Gram (g)',
    13 => 'Kilogram (kg)',
    14 => 'Clove',
    15 => 'Whole',
    16 => 'Head',
    17 => 'Stalk',
    18 => 'Sprig',
    20 => 'Half'
  ];


  public function measurement_type() {
    if($this->measurement_id > 0) {
      return self::MEASUREMENT_TYPE[$this->measurement_id];
    } else {
      return "Unknown";
    }
  }

}


?>
