<?php 
  require_once('../../private/initialize.php');
  $page_title = 'Recipes';
  include(SHARED_PATH . '/public_header.php');
?>

<h2>Recipes</h2>

<?php if($session->is_logged_in()) { ?>

  <a href="<?php echo url_for('new.php') ?>">Add a Recipe</a>

<?php } ?>

    <br>
    <table border="1">
      <tr>
        <th>Recipe</th>
        <th>Instructions</th>
        <th>Cooking time</th>
        <th>Difficulty</th>
        <th>Cuisine Type</th>
        <th>Meal Type</th>
        <th>&nbsp;</th>
        <?php if($session->is_logged_in()) { ?> 
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
        <td><?php echo h($recipe->recipe_name); ?></td>
        <td><?php echo h($recipe->instructions); ?></td>
        <td><?php echo h($recipe->cooking_time); ?></td>
        <td><?php echo h(Difficulty::DIFFICULTY_OPTIONS[$recipe->difficulty]); ?></td>
        <td><?php echo h(Cuisine::CUISINE_OPTIONS[$recipe->cuisine_type]); ?></td>
        <td><?php echo h(MealType::MEAL_OPTIONS[$recipe->meal_type]); ?></td>
        <td><a href="detail.php?id=<?php echo $recipe->id; ?>">View</a></td>
        <td><a href="edit.php?id=<?php echo $recipe->id; ?>">Edit</a></td>
        <td><a href="<?php echo url_for('delete.php?id=' . h(u($recipe->id))); ?>">Delete</a></td>
      </tr>
      <?php } ?>

    </table>


<?php include(SHARED_PATH . '/public_footer.php'); ?>
