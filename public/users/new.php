<?php

require_once('../../private/initialize.php');

// require_login();

if(is_post_request()) {

  // Create record using post parameters
  $args = $_POST['user'];
  $user = new user($args);
  $result = $user->save();

  if($result === true) {
    $new_id = $user->user_id;
    $session->message('The user was created successfully.');
    redirect_to(url_for('/users/show.php?id=' . $new_id));
  } else {
    // show errors
  }

} else {
  // display the form
  $user = new user;
}

?>

<?php $page_title = 'Create user'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/users/index.php'); ?>">&laquo; Back to List</a>

  
    <h1>Create user</h1>

    <?php echo display_errors($user->errors); ?>

    <form action="<?php echo url_for('/users/new.php'); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Create user">
      </div>
    </form>

 

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
