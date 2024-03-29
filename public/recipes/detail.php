<?php require_once('../../private/initialize.php'); ?>

<?php

  // Get requested ID

  $id = $_GET['id'] ?? false;

  if(!$id) {
    redirect_to('recipes.php');
  }

  // Find recipe using ID

  $recipe = Recipe::find_by_recipe($id);
  $ingredients = Ingredients::find_all_by_recipe($id);
  // var_dump($ingredients);

?>

<?php $page_title = $recipe->recipe_name; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

  <a href="recipes.php">Back to Recipes</a>

      <h1><?php echo h($recipe->recipe_name); ?></h1>
      <br>
      <ul>
        <li>Cook Time: <?php echo h($recipe->cooking_time); ?> minutes</li>
        <li>Difficulty: <?php echo h(Difficulty::DIFFICULTY_OPTIONS[$recipe->difficulty]); ?></li>
        <li>Cuisine Type: <?php echo h(Cuisine::CUISINE_OPTIONS[$recipe->cuisine_type]); ?></li>
        <li>Meal Type: <?php echo h(MealType::MEAL_OPTIONS[$recipe->meal_type]); ?></li>
        <?php foreach ($ingredients as $ingredient) {
        echo "<li>";
        echo h($ingredient->measurement_num) . " ";
        echo h(MeasurementType::MEASUREMENT_TYPE[$ingredient->measurement_type]) . " ";
        echo h(IngredientName::INGREDIENT_OPTIONS[$ingredient->ingredient_name]);
        echo "</li>";
        }
        ?>
        <li>Instructions: <?php echo h($recipe->instructions); ?></li>
      </ul>

    
<?php include(SHARED_PATH . '/public_footer.php'); ?>
