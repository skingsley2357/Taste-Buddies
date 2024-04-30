<?php

/**
 * Represents a MeasurementType entity with properties and methods to manage measurement data.
 */
class MeasurementType extends DatabaseObject {

  /**
   * The database table name associated with the MeasurementType class.
   * @var string
   */
  static protected $table_name = 'measurement_type';

  /**
   * The database columns to be used with the MeasurementType class.
   * @var array
   */
  static protected $db_columns = ['measurement_id', 'measurement'];
  
  /**
   * The identifier for the measurement type.
   * @var int
   */
  public $measurement_id;

  /**
   * The name of the measurement.
   * @var string
   */
  public $measurement;

  /**
   * Constructor for the MeasurementType class.
   * Initializes the measurement properties.
   * @param int $measurement_id - The unique identifier of the measurement type.
   * @param string $measurement - The name of the measurement type.
   */
  public function __construct($measurement_id, $measurement) {
    $this->measurement_id = $measurement_id;
    $this->measurement = $measurement;
  }

  /**
   * List of measurement types mapped by measurement ID.
   */
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

  /**
   * Retrieves the measurement type name based on the measurement ID.
   * Returns 'Unknown' if the measurement ID does not exist in the list.
   * @return string - The name of the measurement type.
   */
  public function measurement_type() {
    if($this->measurement_id > 0) {
      return self::MEASUREMENT_TYPE[$this->measurement_id];
    } else {
      return "Unknown";
    }
  }

}

?>
