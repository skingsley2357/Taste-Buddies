<?php

require_once('../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('index.php'));
}
$id = $_GET['id'];
$recipe = Recipe::find_by_recipe($id);
$ingredients = Ingredients::find_all_by_recipe($id);
if($recipe == false) {
  redirect_to(url_for('index.php'));
}

if(is_post_request()) {

  foreach($ingredients as $ingredient) {
    $ingredient->delete_related_ingredients($id);
  }
  
  $result= $recipe->delete_recipe();

  if($result === true) {
    $_SESSION['message'] = 'The recipe was deleted successfully.';
    redirect_to(url_for('index.php'));
  }


} else {
  // Display form
}

?>

<?php $page_title = 'Delete recipe'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('index.php'); ?>">&laquo; Back to List</a>

  <div class="recipe delete">
    <h1>Delete recipe</h1>
    <p>Are you sure you want to delete this recipe?</p>
    <p class="item"><?php echo h($recipe->recipe_name); ?></p>

    <form action="<?php echo url_for('/recipes/delete.php?id=' . h(u($id))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete recipe" />
      </div>
    </form>
  </div>

</div>



<?php include(SHARED_PATH . '/public_footer.php'); ?>
