<?php

// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
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
      <div id="ingredientsList">
        <div>
          <input type="number" name="ingredients[measurement_num][]" placeholder="Quantity" required>
          <select name="ingredients[measurement_type][]" required>
            <option value="">Select Measurement Type</option>
            <?php foreach(Ingredients::MEASUREMENT_TYPE as $measurement_id => $measurement): ?>
              <option value="<?php echo $measurement_id; ?>" <?php if($ingredients->measurement_type == $measurement_id) {echo 'selected'; } ?>><?php echo $measurement; ?></option>
            <?php endforeach; ?>
          </select>
          <select id="ingredient_name" name="ingredients[ingredient_name][]" required>
            <option value="">Select Ingredient</option>
            <?php foreach(Ingredients::INGREDIENT_OPTIONS as $ing_id => $ing_name): ?>
              <option value="<?php echo $ing_id; ?>" <?php if($ingredients->ingredient_name == $ing_id) {echo 'selected'; } ?>><?php echo $ing_name; ?></option>
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

  <dl>
    <dt><label for="recipeImage">Recipe Image:</label></dt>
    <dd><input id="form-img" type="file" id="recipeImage" name="recipe_image" accept="image/jpeg, image/png, image/jpg"></dd>
  </dl>
