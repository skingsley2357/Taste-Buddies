<?php require_once('../../private/initialize.php'); ?>

<?php

  // Get requested ID

  $id = $_GET['id'] ?? false;

  if(!$id) {
    redirect_to('recipes.php');
  }

  $recipe = Recipe::find_by_recipe($id);
  $ingredients = Ingredients::find_all_by_recipe($id);
  $image = Images::find_by_recipe($id);
  $user_id = $recipe->user_id;
  $user = User::find_by_id($user_id);

?>

<?php $page_title = $recipe->recipe_name; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

  <a href="recipes.php">Back to Recipes</a>

      <h1><?php echo h($recipe->recipe_name); ?></h1>
      <h2>Recipe by <?php echo h($user->user_name);  ?></h2>
      <br>
      <ul>
        <li>Cook Time: <?php echo h($recipe->cooking_time); ?> minutes</li>
        <li>Difficulty: <?php echo h(Difficulty::DIFFICULTY_OPTIONS[$recipe->difficulty]); ?></li>
        <li>Cuisine Type: <?php echo h(Cuisine::CUISINE_OPTIONS[$recipe->cuisine_type]); ?></li>
        <li>Meal Type: <?php echo h(MealType::MEAL_OPTIONS[$recipe->meal_type]); ?></li>
        <?php foreach ($ingredients as $ingredient) {
        echo "<li>";
        echo h($ingredient->measurement_num) . " ";
        echo h(Ingredients::MEASUREMENT_TYPE[$ingredient->measurement_type]) . " ";
        echo h(Ingredients::INGREDIENT_OPTIONS[$ingredient->ingredient_name]);
        echo "</li>";
        }
        ?>
        <li>Instructions: <?php echo h($recipe->instructions); ?></li>
      </ul>

      <img src="<?php echo h($image->file_path) ?>" alt="image of <?php echo h($recipe->recipe_name) ?>"></img>
 
<?php include(SHARED_PATH . '/public_footer.php'); ?>
