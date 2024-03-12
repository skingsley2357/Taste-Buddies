<?php require_once('../../private/initialize.php'); ?>

<?php

  // Get requested ID

  $id = $_GET['id'] ?? false;

  if(!$id) {
    redirect_to('recipes.php');
  }

  // Find recipe using ID

  $recipe = Recipe::find_by_recipe($id);
  

?>

<?php $page_title = $recipe->recipe_name; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

  <a href="recipes.php">Back to Recipes</a>

      <h1><?php echo h($recipe->recipe_name); ?></h1>
      <br>
      <h1>A list of ingredients and cooking instructions will go here</h1>

    
<?php include(SHARED_PATH . '/public_footer.php'); ?>
