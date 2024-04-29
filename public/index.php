<?php 
require_once('../private/initialize.php');
include(SHARED_PATH . '/public_header.php'); 
?>

<h1 id='home-h1'>Taste Buddies</h1>

<main id='home'>
  <p>Welcome to our vibrant community of culinary enthusiasts! At Taste Buddies, we believe that the joy of cooking is best when shared. Whether you're a seasoned chef or a kitchen novice, our platform is designed for you to explore, discover, and contribute to a treasure trove of delightful recipes. From mouthwatering main courses to decadent desserts, our collection celebrates diverse tastes and cultures. Join us on a gastronomic journey where every recipe tells a story, and every dish is an opportunity to connect, inspire, and savor the flavors of homemade goodness. Prepare for a delicious adventure – your next culinary masterpiece awaits!</p>
  <img src="images/rawimage.jpg" alt="fresh vegetables" width=210 height=358>
</main>

<?php 
  $recipes = Recipe::find_all();
  ?>

<section id='home-recipes'>
  <h2><a href="recipes/recipes.php">Recipes</a></h2>
  <?php 
    foreach ($recipes as $recipe) { 
      $image = Images::find_by_recipe($recipe->recipe_id);
      $user = User::find_by_id($recipe->user_id);
  ?>
      <div class='recipe-cards'>
        <img src="uploads/<?php echo h($image->file_path) ?>" alt="Image of <?php echo h($recipe->recipe_name) ?>">
        <p><?php echo h($recipe->recipe_name); ?>
        <br>
        <?php echo h($user->user_name); ?></p>
      </div>
  <?php } ?>
  
</section>


<?php include(SHARED_PATH . '/public_footer.php'); ?>
