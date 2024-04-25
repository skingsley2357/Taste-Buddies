<?php

require_once('../../private/initialize.php');

require_login();

if(is_post_request()) {

  $args = $_POST['recipe'];

  if(isset($args['cuisine_id'])) {
    $args['cuisine_type'] = $args['cuisine_id'];
    unset($args['cuisine_id']);
  }

  error_log("Session User ID: " . $session->user_id);

  $recipe = new Recipe($args);
  $recipe->user_id = $session->user_id;
  $result = $recipe->create_recipe();

  if($result === true) {
    $new_id = $recipe->id;

    if (isset($_FILES['recipe_image']) && $_FILES['recipe_image']['error'] == 0) {
      $image_result = Images::handle_file_upload($_FILES['recipe_image'], $new_id);
      if ($image_result !== true) {
          $image = new Images;
          $image->recipe_id = $new_id;
          $image_result = $image->create_image();
          if ($image_result !== true) {
              $errors[] = $image_result;  // handle any error from create_image
          }
      }
    }
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
    <form action="<?php echo url_for('/recipes/new.php'); ?>" method="post" enctype="multipart/form-data">

      <?php include('form_fields.php'); ?>

        <input type="submit" value="Create Recipe">

    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
