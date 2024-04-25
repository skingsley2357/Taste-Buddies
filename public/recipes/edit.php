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

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['recipe'];
  if(isset($args['cuisine_id'])) {
    $args['cuisine_type'] = $args['cuisine_id'];
    unset($args['cuisine_id']);
  }
  $recipe->merge_attributes($args);
  $result = $recipe->update_recipe();

  if($result === true) {
    $new_id = $recipe->id;
    
    for($i = 0; $i < count($_POST['ingredients']['measurement_num']); $i++) {
      $ingredient_data = [
        'measurement_num' => $_POST['ingredients']['measurement_num'][$i],
        'measurement_type' => $_POST['ingredients']['measurement_type'][$i],
        'ingredient_name' => $_POST['ingredients']['ingredient_name'][$i]
      ];
      $ingredient = new Ingredients($ingredient_data);
      $ingredient->recipe_id = $new_id;
      $ingredient->update_recipe();
    }

    $_SESSION['message'] = 'The recipe was created successfully.';
    redirect_to(url_for('recipes/detail.php?id=' . $new_id));
  } else {
    // show errors
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

    <form action="<?php echo url_for('/recipes/edit.php?id=' . h(u($id))); ?>" method="post">

          <?php


          if(!isset($recipe)) {
            redirect_to(url_for('index.php'));
          }
          ?>
          <dl>
            <dt><label for="recipeName">Recipe Name:</label></dt>
            <dd><input type="text" id="recipeName" name="recipe[recipe_name]" <?php echo h($recipe->recipe_name); ?> required></dd>
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
              <div id="ingredientsList">
                <div>
                  <input type="number" name="ingredients[measurement_num][]" placeholder="Quantity" required>

                    <select name="ingredients[measurement_type][]" required>
                      <option value="">Select Measurement Type</option>
                      <?php foreach($ingredients as $ingredient): ?>
                          <?php foreach(Ingredients::MEASUREMENT_TYPE as $measurement_id => $measurement): ?>
                              <option value="<?php echo $measurement_id; ?>" <?php if($ingredient->measurement_type == $measurement_id) { echo 'selected'; } ?>>
                                  <?php echo $measurement; ?>
                              </option>
                          <?php endforeach; ?>
                      <?php endforeach; ?>
                    </select>

                    <select id="ingredient_name" name="ingredients[ingredient_name][]" required>
                      <option value="">Select Ingredient</option>
                      <?php foreach($ingredients as $ingredient): ?>
                          <?php foreach(Ingredients::INGREDIENT_OPTIONS as $ing_id => $ing_name): ?>
                              <option value="<?php echo $ing_id; ?>" <?php if($ingredient->ingredient_name == $ing_id) { echo 'selected'; } ?>>
                                  <?php echo $ing_name; ?>
                              </option>
                          <?php endforeach; ?>
                      <?php endforeach; ?>
                    </select>
                </div>
              </div>
            </dd>
            <br>
            <dd><button type="button" onclick="addIngredient()">Add More Ingredients</button></dd>
          </dl>

          <dl>
            <dt><label for="instructions">Instructions:</label></dt>
            <dd><textarea id="instructions" name="recipe[instructions]" required><?php echo h($recipe->instructions); ?></textarea></dd>
          </dl>

          <input type="submit" value="Edit recipe" />

      </form>

  </div>



<?php include(SHARED_PATH . '/public_footer.php'); ?>
