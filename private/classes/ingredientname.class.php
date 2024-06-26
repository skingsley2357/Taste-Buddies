<?php

/**
 * Represents an IngredientName entity with properties and methods to manage ingredient data.
 */
class IngredientName extends DatabaseObject {

  /**
   * The database table name associated with the IngredientName class.
   * @var string
   */
  static protected $table_name = 'ingredient_name';

  /**
   * The database columns to be used with the IngredientName class.
   * @var array
   */
  static protected $db_columns = ['Ingredient_name_id', 'ingredient'];
  
  /**
   * The identifier for the ingredient.
   * @var int
   */
  public $Ingredient_name_id;

  /**
   * The name of the ingredient.
   * @var string
   */
  public $ingredient;

  /**
   * Constructor for the IngredientName class.
   * @param int $Ingredient_name_id - The unique identifier of the ingredient.
   * @param string $ingredient - The name of the ingredient.
   */
  public function __construct($Ingredient_name_id, $ingredient) {
      $this->Ingredient_name_id = $Ingredient_name_id;
      $this->ingredient = $ingredient;
  }

  /**
   * List of ingredient options mapped by ingredient ID.
   */
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

  /**
   * Retrieves the ingredient name based on the ingredient ID.
   * Returns 'Unknown' if the ingredient ID does not exist in the list.
   * @return string - The name of the ingredient.
   */
  public function ingredient() {
    if($this->Ingredient_name_id > 0) {
      return self::INGREDIENT_OPTIONS[$this->Ingredient_name_id];
    } else {
      return "Unknown";
    }
  }

}

?>
