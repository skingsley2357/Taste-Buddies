<?php

/**
 * Represents an Ingredients entity with properties and methods to manage ingredient data for recipes.
 */
class Ingredients extends DatabaseObject {

  /**
   * The database table name associated with the Ingredients class.
   * @var string
   */
  static protected $table_name = 'ingredients';

  /**
   * The database columns to be used with the Ingredients class.
   * @var array
   */
  static protected $db_columns = ['ingredient_id', 'recipe_id', 'ingredient_name', 'measurement_type', 'measurement_num'];

  /**
   * The identifier for the ingredient.
   * @var int
   */
  public $ingredient_id;

  /**
   * The associated recipe identifier.
   * @var int
   */
  public $recipe_id;

  /**
   * The name of the ingredient.
   * @var string
   */
  public $ingredient_name;

  /**
   * The type of measurement used for the ingredient.
   * @var string
   */
  public $measurement_type;

  /**
   * The numerical value of the measurement for the ingredient.
   * @var float
   */
  public $measurement_num;

  /**
   * Constructor for the Ingredients class.
   * Initializes the ingredient properties using an associative array.
   * @param array $args - Associative array of properties to set.
   */
  public function __construct($args=[]) {
    $this->ingredient_id = $args['ingredient_id'] ?? '';
    $this->recipe_id = $args['recipe_id'] ?? '';
    $this->ingredient_name = $args['ingredient_name'] ?? '';
    $this->measurement_type = $args['measurement_type'] ?? '';
    $this->measurement_num = $args['measurement_num'] ?? '';
  }

  /**
   * Finds an ingredient by its ID.
   * @param int $ingredient_id - The ID of the ingredient to find.
   * @return mixed - Ingredient object if found, false otherwise.
   */
  public static function find_by_ingredient_id($ingredient_id) {
    global $database;  // Ensure that your global database connection variable is used
    $sql = "SELECT * FROM " . static::$table_name . " WHERE ingredient_id='" . $database->escape_string($ingredient_id) . "' LIMIT 1";
    $result = $database->query($sql);
    if ($row = $result->fetch_assoc()) {
        return self::instantiate($row);
    } else {
        return false;  // No ingredient found
    }
  }

  /**
   * Updates an existing ingredient in the database.
   * @return bool - True on success, false on failure.
   */
  public function update_ingredient() {
    $this->validate();
    if (!empty($this->errors)) { return false; }

    $attributes = $this->sanitized_attributes();
    $attribute_pairs = [];
    foreach ($attributes as $key => $value) {
        $attribute_pairs[] = "{$key}='{$value}'";
    }

    $sql = "UPDATE " . static::$table_name . " SET ";
    $sql .= join(', ', $attribute_pairs);
    $sql .= " WHERE ingredient_id='" . self::$database->escape_string($this->ingredient_id) . "' LIMIT 1";
    $result = self::$database->query($sql);
    return $result;
  }

  /**
   * Deletes an ingredient by its ID.
   * @param int $ingredient_id - The ID of the ingredient to delete.
   * @return bool - True on success, false on failure.
   */
  public static function delete_by_id($ingredient_id) {
    global $database;
    $sql = "DELETE FROM ingredients WHERE ingredient_id = ?";
    $stmt = $database->prepare($sql);
    $stmt->bind_param("i", $ingredient_id);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
  }



  function delete_related_ingredients($recipe_id) {
    global $database;  // Assuming $database is your database connection object
    $query = "DELETE FROM ingredients WHERE recipe_id = ?";
    $stmt = $database->prepare($query);
    if ($stmt) {
        $stmt->bind_param('i', $recipe_id);  // 'i' denotes the variable type is integer
        $stmt->execute();
        $stmt->close();
        return true;
    } else {
        return false;  // Handle errors appropriately
    }
  }

  public const INGREDIENT_OPTIONS = [
    1 => 'Onion',
    2 => 'Garlic',
    3 => 'Tomato',
    4 => 'Potato',
    5 => 'Carrot',
    6 => 'Bell pepper',
    7 => 'Broccoli',
    8 => 'Spinach',
    9 => 'Mushroom',
    10 => 'Zucchini',
    11 => 'Apple',
    12 => 'Banana',
    13 => 'Orange',
    14 => 'Lemon',
    15 => 'Avocado',
    16 => 'Strawberries',
    17 => 'Blueberries',
    18 => 'Raspberries',
    19 => 'Mango',
    20 => 'Pineapple',
    21 => 'Watermelon',
    22 => 'Grapes',
    23 => 'Basil',
    24 => 'Thyme',
    25 => 'Rosemary',
    26 => 'Oregano',
    27 => 'Cilantro',
    28 => 'Parsley',
    29 => 'Mint',
    30 => 'Cumin',
    31 => 'Paprika',
    32 => 'Garlic powder',
    33 => 'Chicken',
    34 => 'Ground Beef',
    35 => 'Pork',
    36 => 'Salmon',
    37 => 'Cod',
    38 => 'Tilapia',
    39 => 'Shrimp',
    40 => 'Tofu',
    41 => 'Eggs',
    42 => 'Turkey',
    43 => 'Lamb',
    44 => 'Black beans',
    45 => 'Kidney beans',
    46 => 'Chickpeas',
    47 => 'Rice',
    48 => 'Pasta',
    49 => 'Quinoa',
    50 => 'Bread',
    51 => 'Potatoes',
    52 => 'Couscous',
    53 => 'Oats',
    54 => 'Barley',
    55 => 'Farro',
    56 => 'Bulgur',
    57 => 'Milk',
    58 => 'Cheddar cheese',
    59 => 'Mozzarella cheese',
    60 => 'Parmesan cheese',
    61 => 'Butter',
    62 => 'Yogurt',
    63 => 'Cream',
    64 => 'Eggs',
    65 => 'Almond milk',
    66 => 'Coconut milk',
    67 => 'Greek yogurt',
    68 => 'Sour cream',
    69 => 'Olive oil',
    70 => 'Soy sauce',
    71 => 'Balsamic vinegar',
    72 => 'Red wine vinegar',
    73 => 'Apple cider vinegar',
    74 => 'Mustard',
    75 => 'Ketchup',
    76 => 'Mayonnaise',
    77 => 'Hot sauce',
    78 => 'Sriracha',
    79 => 'Tomato sauce',
    80 => 'Pesto',
    81 => 'Almonds',
    82 => 'Walnuts',
    83 => 'Pecans',
    84 => 'Pistachios',
    85 => 'Sunflower seeds',
    86 => 'Chia seeds',
    87 => 'Flaxseeds',
    88 => 'Pumpkin seeds',
    89 => 'Sesame seeds',
    90 => 'Peanuts',
  ];

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

}

?>
