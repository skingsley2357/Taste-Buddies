<?php 
  require_once('../../private/initialize.php');
  $page_title = 'Recipes';
  include(SHARED_PATH . '/public_header.php');
?>
<div id="recipes">
<h2>Recipes</h2>

<?php if($session->is_logged_in()) { ?>

  <a href="<?php echo url_for('recipes/new.php') ?>">Add a Recipe</a>

<?php } ?>

    <br>
    <table id="recipes-table">
      <tr>
        <th>Recipe</th>
        <th>Cooking time</th>
        <th>Difficulty</th>
        <th>Cuisine Type</th>
        <th>Meal Type</th>
        <?php if($session->is_admin_logged_in()) { ?> 
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <?php } ?>
      </tr>

<?php

// Create a new recipe object that uses the find_all() method

$recipes = Recipe::find_all();


?>
      <?php foreach($recipes as $recipe) { ?> 
      <tr>
        <td><a href="detail.php?id=<?php echo $recipe->recipe_id; ?>"><?php echo h($recipe->recipe_name); ?></a></td>
        <td><?php echo h($recipe->cooking_time); ?></td>
        <td><?php echo h(Difficulty::DIFFICULTY_OPTIONS[$recipe->difficulty]); ?></td>
        <td><?php echo h(Cuisine::CUISINE_OPTIONS[$recipe->cuisine_type]); ?></td>
        <td><?php echo h(MealType::MEAL_OPTIONS[$recipe->meal_type]); ?></td>
        <?php if ($session->is_admin == 2) : ?>
        <td><a href="edit.php?id=<?php echo $recipe->recipe_id; ?>">Edit</a></td>
        <td><a href="<?php echo url_for('delete.php?id=' . h(u($recipe->recipe_id))); ?>">Delete</a></td>
        <?php endif ?>
      </tr>
      <?php } ?>

    </table>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
