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
    <div id="recipe-page">
      <h1><?php echo h($recipe->recipe_name); ?></h1>
      <h2>Recipe by <?php echo h($user->user_name);  ?></h2>
      <br>
      <div id="multiplier">
        <p><b>Ingredient Multiplier:</b></p>
        <input type="radio" name="scale" value="0.5" id="half">
        <label for="half">X&#189;</label>
        <input type="radio" name="scale" value="1" id="full" checked>
        <label for="full">X1</label>
        <input type="radio" name="scale" value="2" id="double">
        <label for="double">X2</label>
        <input type="radio" name="scale" value="3" id="triple">
        <label for="triple">X3</label>
        <input type="radio" name="scale" value="4" id="quadruple">
        <label for="quadruple">X4</label>
      </div>
      <div id="recipe-flex">
        <ul>
          <li><b>Cook Time:</b> <?php echo h($recipe->cooking_time); ?> minutes</li>
          <li><b>Difficulty:</b> <?php echo h(Difficulty::DIFFICULTY_OPTIONS[$recipe->difficulty]); ?></li>
          <li><b>Cuisine Type:</b> <?php echo h(Cuisine::CUISINE_OPTIONS[$recipe->cuisine_type]); ?></li>
          <li><b>Meal Type:</b> <?php echo h(MealType::MEAL_OPTIONS[$recipe->meal_type]); ?></li>
          <?php foreach ($ingredients as $ingredient) {
          echo "<li>";
          echo h($ingredient->measurement_num) . " ";
          echo h(Ingredients::MEASUREMENT_TYPE[$ingredient->measurement_type]) . " ";
          echo h(Ingredients::INGREDIENT_OPTIONS[$ingredient->ingredient_name]);
          echo "</li>";
          }
          ?>
          <li><b>Instructions:</b> <?php echo h($recipe->instructions); ?></li>
        </ul>

        <?php if (!empty($image->file_path)) : ?>
          <img src="../../public/uploads/<?php echo h($image->file_path) ?>" alt="Image of <?php echo h($recipe->recipe_name) ?>">
        <?php endif; ?>
      </div>

      <?php // Check if user is logged in and the user IDs match
        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $recipe->user_id) {
          // Display links to edit and delete pages
          echo '<a href="edit.php?id=' . $id . '">Edit Recipe</a>';
          echo ' | ';
          echo '<a href="delete.php?id=' . $id . '">Delete Recipe</a>';
        }
      ?>
    </div>
 
<?php include(SHARED_PATH . '/public_footer.php'); ?>
