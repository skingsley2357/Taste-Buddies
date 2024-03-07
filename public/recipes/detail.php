<?php require_once('../../private/initialize.php'); ?>

<?php

  // Get requested ID

  $id = $_GET['id'] ?? false;

  if(!$id) {
    redirect_to('recipes.php');
  }

  // Find recipe using ID

  $recipe = Recipe::find_by_id($id);
  

?>

<?php $page_title = 'Detail: ' . $recipe->common_name; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

  <a href="recipes.php">Back to Inventory</a>

      <dl>
        <dt>ID</dt>
        <dd><?php echo h($recipe->id); ?></dd>
      </dl>
      <dl>
        <dt>Name</dt>
        <dd><?php echo h($recipe->common_name); ?></dd>
      </dl>
      <dl>
        <dt>Habittat</dt>
        <dd><?php echo h($recipe->habitat); ?></dd>
      </dl>
      <dl>
        <dt>Food</dt>
        <dd><?php echo h($recipe->food); ?></dd>
      </dl>
      <dl>
        <dt>Conservation Level</dt>
        <dd><?php echo h($recipe->conservation()); ?></dd>
      </dl>
      <dl>
        <dt>Backyard Tips</dt>
        <dd><?php echo h($recipe->backyard_tips); ?></dd>
      </dl>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
