<?php

require_once('../../private/initialize.php');

require_login();

if(is_post_request()) {

  // Create record using post parameters
  $args = $_POST['recipe'];
  $recipe = new Recipe($args);
  $result = $recipe->save();

  if($result === true) {
    $new_id = $recipe->id;
    $_SESSION['message'] = 'The recipe was created successfully.';
    redirect_to(url_for('detail.php?id=' . $new_id));
  } else {
    // show errors
  }

} else {
  // display the form
  $recipe = new recipe;
  $ingredients = new ingredients;
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
