<?php

require_once('../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('index.php'));
}
$id = $_GET['id'];
$recipe = Recipe::find_by_id($id);
if($recipe == false) {
  redirect_to(url_for('index.php'));
}

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['recipe'];
  $recipe->merge_attributes($args);
  $result = $recipe->save();

  if($result === true) {
    $_SESSION['message'] = 'The recipe was updated successfully.';
    redirect_to(url_for('show.php?id=' . $id));
  } else {
    // show errors
  }

} else {

  // display the form

}

?>

<?php $page_title = 'Edit recipe'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('index.php'); ?>">&laquo; Back to List</a>

  <div class="recipe edit">
    <h1>Edit recipe</h1>

    <?php echo display_errors($recipe->errors); ?>

    <form action="<?php echo url_for('edit.php?id=' . h(u($id))); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Edit recipe" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
