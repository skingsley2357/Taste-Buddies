<?php

require_once('../../private/initialize.php');

require_login();

if(is_post_request()) {

  // Create record using post parameters
  $args = $_POST['recipe'];

  if($session->is_logged_in()) {
    $args['user_id'] = $session->get_user_id(); // Adjust this if user_id needs to be retrieved differently
  }

  if(isset($args['cuisine_id'])) {
    $args['cuisine_type'] = $args['cuisine_id'];
    unset($args['cuisine_id']); // Remove the original 'cuisine_id' to avoid confusion
  }

  $recipe = new Recipe($args);
  $result = $recipe->save();

  if($result === true) {
    $new_id = $recipe->id;
    
    // New loop for processing multiple ingredients
    for($i = 0; $i < count($_POST['ingredients']['measurement_num']); $i++) {
        $ingredient_data = [
            'measurement_num' => $_POST['ingredients']['measurement_num'][$i],
            'measurement_type' => $_POST['ingredients']['measurement_type'][$i],
            'ingredient_name' => $_POST['ingredients']['ingredient_name'][$i]
        ];
        $ingredient = new Ingredients($ingredient_data);
        $ingredient->recipe_id = $new_id;
        $ingredient->save();
    }

    $_SESSION['message'] = 'The recipe was created successfully.';
    redirect_to(url_for('recipes/detail.php?id=' . $new_id));
  } else {
    // show errors
  }

} else {
  // display the form
  $recipe = new Recipe();
  $ingredients = new Ingredients();
}

?>

<?php $page_title = 'Create recipe'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('index.php'); ?>">&laquo; Back to List</a>

  <div class="recipe new">
    <h1>Create recipe</h1>

    <form action="<?php echo url_for('/recipes/new.php'); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Create Recipe" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
