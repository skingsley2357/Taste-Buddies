<?php

require_once('../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('index.php'));
}
$id = $_GET['id'];
$recipe = Recipe::find_by_recipe($id);
$ingredients = Ingredients::find_all_by_recipe($id); // Assume this method exists to fetch ingredients

if($recipe == false) {
  redirect_to(url_for('index.php'));
}

$deleted_ingredient_id = $_SESSION['deleted_ingredient_id'] ?? null;
unset($_SESSION['deleted_ingredient_id']); // Clear the session variable after use

if(is_post_request()) {

    if (isset($_POST['delete_ingredients']) && is_array($_POST['delete_ingredients'])) {
      foreach ($_POST['delete_ingredients'] as $ingredient_id) {
        Ingredients::delete_by_id($ingredient_id);
      }
    }

  // Save record using post parameters
  $args = $_POST['recipe'];

  if(isset($args['cuisine_id'])) {
    $args['cuisine_type'] = $args['cuisine_id'];
    unset($args['cuisine_id']);
  }
  $recipe->merge_attributes($args);
  $result = $recipe->update_recipe();

  if ($result === true) {
    $new_id = $recipe->recipe_id;

    if (isset($_FILES['recipe_image']) && $_FILES['recipe_image']['error'] == 0) {
        $image_result = Images::handle_file_upload($_FILES['recipe_image'], $new_id);
        if ($image_result !== true) {
            $errors[] = $image_result;
        }
    }

    // Enhanced checks for 'ingredients' data
    if (isset($_POST['ingredients']) && is_array($_POST['ingredients'])) {
        $measurement_nums = $_POST['ingredients']['measurement_num'] ?? null;
        $measurement_types = $_POST['ingredients']['measurement_type'] ?? null;
        $ingredient_names = $_POST['ingredients']['ingredient_name'] ?? null;

        if (is_array($measurement_nums) && is_array($measurement_types) && is_array($ingredient_names) &&
            count($measurement_nums) === count($measurement_types) && count($measurement_nums) === count($ingredient_names)) {
            for ($i = 0; $i < count($measurement_nums); $i++) {
                $ingredient_data = [
                    'measurement_num' => $measurement_nums[$i],
                    'measurement_type' => $measurement_types[$i],
                    'ingredient_name' => $ingredient_names[$i]
                ];
                $ingredient = new Ingredients($ingredient_data);
                $ingredient->recipe_id = $new_id;
                $ingredient->update_recipe();
            }
        } else {
            $errors[] = "Ingredient data arrays do not match in length or are incomplete.";
        }
    } else {
        $errors[] = "Ingredient data is not provided or is not in the correct format.";
    }
    redirect_to(url_for('recipes/detail.php?id=' . $new_id));
  }
} else {
  // display the form
}

?>

<?php $page_title = 'Edit recipe'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

  <a class="back-link" href="<?php echo url_for('index.php'); ?>">&laquo; Back to List</a>

  <div class="recipe edit">
    <h1>Edit recipe</h1>

    <?php echo display_errors($recipe->errors); ?>

    <form action="<?php echo url_for('/recipes/edit.php?id=' . h(u($id))); ?>" method="post" enctype="multipart/form-data">

          <?php


          if(!isset($recipe)) {
            redirect_to(url_for('index.php'));
          }
          ?>
          <dl>
            <dt><label for="recipeName">Recipe Name:</label></dt>
            <dd><input type="text" id="recipeName" name="recipe[recipe_name]" value="<?php echo h($recipe->recipe_name); ?>" required></dd>
          </dl>

          <dl>
            <dt><label for="cookingTime">Cooking Time (in minutes):</label></dt>
            <dd><input type="number" id="cookingTime" name="recipe[cooking_time]" value="<?php echo h($recipe->cooking_time); ?>" required></dd>
          </dl>

          <dl>
            <dt><label for="mealType">Meal Type:</label></dt>
            <dd>
              <select id="mealType" name="recipe[meal_type]" required>
                <option value="">Select Meal Type</option>
                <?php foreach(MealType::MEAL_OPTIONS as $meal_id => $meal_name) { ?>
                  <option value="<?php echo $meal_id; ?>" <?php if($recipe->meal_type == $meal_id) {echo 'selected'; } ?>><?php echo $meal_name; ?></option>
                <?php } ?>
              </select>
            </dd>
          </dl>

          <dl>
            <dt><label for="cuisine">Cuisine:</label></dt>
            <dd>
              <select id="cuisine" name="recipe[cuisine_id]" required>
                  <option value="">Select Cuisine</option>
                  <?php foreach(Cuisine::CUISINE_OPTIONS as $cuisine_id => $cuisine_name): ?>
                    <option value="<?php echo $cuisine_id; ?>" <?php if($recipe->cuisine_type == $cuisine_id) {echo 'selected'; } ?>><?php echo $cuisine_name; ?></option>
                  <?php endforeach; ?>
              </select>
            </dd>
          </dl>

          <dl>
            <dt><label for="difficulty">Difficulty:</label></dt>
            <dd>
              <select id="difficulty" name="recipe[difficulty]" required>
                  <option value="">Select Difficulty</option>
                  <?php foreach(Difficulty::DIFFICULTY_OPTIONS as $difficulty_id => $difficulty_name): ?>
                    <option value="<?php echo $difficulty_id; ?>" <?php if($recipe->difficulty == $difficulty_id) {echo 'selected'; } ?>><?php echo $difficulty_name; ?></option>
                  <?php endforeach; ?>
              </select>
            </dd>
          </dl>

          <dL>
            <dt><label>Ingredients:</label></dt>
            <dd>
            <?php foreach($ingredients as $outer_ingredient): ?>
              <div id="ingredientsList">
                <input type="checkbox" name="delete_ingredients[]" value="<?php echo h($outer_ingredient->ingredient_id); ?>">
                <input type="number" name="ingredient[measurement_num][]" placeholder="Quantity" value="<?php echo h($outer_ingredient->measurement_num); ?>" required>

                <select name="ingredient[measurement_type][]" required>
                  <option value="">Select Measurement Type</option>
                  <?php foreach(Ingredients::MEASUREMENT_TYPE as $measurement_id => $measurement): ?>
                    <option value="<?php echo $measurement_id; ?>" <?php if($outer_ingredient->measurement_type == $measurement_id) { echo 'selected'; } ?>>
                      <?php echo $measurement; ?>
                    </option>
                  <?php endforeach; ?>
                </select>

                <select id="ingredient_name" name="ingredient[ingredient_name][]" required>
                  <option value="">Select Ingredient</option>
                  <?php foreach(Ingredients::INGREDIENT_OPTIONS as $ing_id => $ing_name): ?>
                    <option value="<?php echo $ing_id; ?>" <?php if($outer_ingredient->ingredient_name == $ing_id) { echo 'selected'; } ?>>
                      <?php echo $ing_name; ?>
                    </option>
                  <?php endforeach; ?>
                  </select>
                
              </div>
              <?php endforeach; ?>
            </dd>
            <br>
            <dd><button type="button" onclick="addIngredient()">Add More Ingredients</button></dd>
          </dl>

          <dl>
            <dt><label for="instructions">Instructions:</label></dt>
            <dd><textarea id="instructions" name="recipe[instructions]" required><?php echo h($recipe->instructions); ?></textarea></dd>
          </dl>

          <dl>
            <dt><label for="recipeImage">Recipe Image:</label></dt>
            <dd><input id="form-img" type="file" id="recipeImage" name="recipe_image" accept="image/jpeg, image/png, image/jpg"></dd>
          </dl>

          <input type="submit" value="Edit recipe" />

      </form>

  </div>



<?php include(SHARED_PATH . '/public_footer.php'); ?>
