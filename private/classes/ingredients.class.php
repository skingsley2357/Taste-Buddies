<?php

class Ingredients extends DatabaseObject {

  static protected $table_name = 'ingredients';
  static protected $db_columns = ['ingredient_id','recipe_id',  'ingredient_name', 'measurement_type', 'measurement_num'];

  public $ingredient_id;
  public $recipe_id;
  public $ingredient_name;
  public $measurement_type;
  public $measurement_num;

  public function __construct($args=[]) {
    $this->ingredient_id = $args['ingredient_id'] ?? '';
    $this->recipe_id = $args['recipe_id'] ?? '';
    $this->ingredient_name = $args['ingredient_name'] ?? '';
    $this->measurement_type = $args['measurement_type'] ?? '';
    $this->measurement_num = $args['measurement_num'] ?? '';
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

  // public function ingredient() {
  //   if($this->ingredient_id > 0) {
  //     return self::INGREDIENT_OPTIONS[$this->ingredient_id];
  //   } else {
  //     return "Unknown";
  //   }
  // }

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


  // public function measurement_type() {
  //   if($this->measurement_type > 0) {
  //     return self::MEASUREMENT_TYPE[$this->measurement_type];
  //   } else {
  //     return "Unknown";
  //   }
  // }

//   static function validate_ingredient_name($ingredient_name) {
//     global $database;  // Ensure that $database is the database connection instance
//     $sql = "SELECT Ingredient_name_id FROM ingredient_name WHERE name = ?";
//     $stmt = $database->prepare($sql);
//     $stmt->bind_param("s", $ingredient_name);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     return ($result->num_rows > 0);
// }

  // public function __construct($ingredient_id = null, $recipe_id = null, $ingredient_name = null, $measurement_type = null, $measurement_num = null) {
  //   $this->ingredient_id = $ingredient_id;
  //   $this->recipe_id = $recipe_id;
  //   $this->ingredient_name = $ingredient_name;
  //   $this->measurement_type = $measurement_type;
  //   $this->measurement_num = $measurement_num;
  // }

}

?>
