<?php

// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($recipe)) {
  redirect_to(url_for('index.php'));
}
?>
  <dl>
    <dt><label for="recipeName">Recipe Name:</label></dt>
    <dd><input type="text" id="recipeName" name="recipe[recipe_name]" required></dd>
  </dl>

  <dl>
    <dt><label for="cookingTime">Cooking Time (in minutes):</label></dt>
    <dd><input type="number" id="cookingTime" name="recipe[cooking_time]" required></dd>
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
          <?php foreach(Cuisine::CUISINE_OPTIONS as $option): ?>
            <option value="<?php echo $option->id; ?>"><?php echo $option->name; ?></option>
          <?php endforeach; ?>
      </select>
    </dd>
  </dl>

  <dl>
    <dt><label for="difficulty">Difficulty:</label></dt>
    <dd>
      <select id="difficulty" name="recipe[difficulty_id]" required>
          <option value="">Select Difficulty</option>
          <?php foreach($difficultyOptions as $option): ?>
            <option value="<?php echo $option->id; ?>"><?php echo $option->name; ?></option>
          <?php endforeach; ?>
      </select>
    </dd>
  </dl>

  <dL>
    <dt><label>Ingredients:</label></dt>
    <dd>
    <div id="ingredientsList">
        <!-- Dynamically add ingredient inputs here -->
        <div>
            <input type="text" name="ingredient[name][]" placeholder="Ingredient Name" required>
            <input type="number" name="ingredient[quantity][]" placeholder="Quantity" required>
            <select name="ingredient[measurement_type_id][]" required>
                <option value="">Select Measurement Type</option>
                <?php foreach($measurementOptions as $option): ?>
                    <option value="<?php echo $option->id; ?>"><?php echo $option->measurement; ?></option>
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
    <dd><textarea id="instructions" name="recipe[instructions]" required></textarea></dd>
  </dl>
