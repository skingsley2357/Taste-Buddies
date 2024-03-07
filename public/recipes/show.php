<?php require_once('../../private/initialize.php'); ?>

<?php

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$recipe = Recipe::find_by_id($id);

?>

<?php $page_title = 'Show recipe: ' . h($recipe->common_name); ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('index.php'); ?>">&laquo; Back to List</a>

  <div class="recipe show">

    <h1>recipe: <?php echo h($recipe->common_name); ?></h1>

    <div class="attributes">
      <dl>
        <dt>Brand</dt>
        <dd><?php echo h($recipe->common_name); ?></dd>
      </dl>
      <dl>
        <dt>Model</dt>
        <dd><?php echo h($recipe->habitat); ?></dd>
      </dl>
      <dl>
        <dt>Year</dt>
        <dd><?php echo h($recipe->food); ?></dd>
      </dl>
      <dl>
        <dt>Condition</dt>
        <dd><?php echo h($recipe->conservation()); ?></dd>
      </dl>
      <dl>  
        <dt>Description</dt>
        <dd><?php echo h($recipe->backyard_tips); ?></dd>
      </dl>
    </div>

  </div>

</div>

