<?php

require_once('../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/users/index.php'));
}
$user_id = $_GET['id'];
$user = user::find_by_id($user_id);
if($user == false) {
  redirect_to(url_for('/users/index.php'));
}

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['user'];
  $user->merge_attributes($args);
  $result = $user->save();

  if($result === true) {
    $session->message('The user was updated successfully.');
    redirect_to(url_for('/users/show.php?id=' . $user_id));
  } else {
    // show errors
  }

} else {

  // display the form

}

?>

<?php $page_title = 'Edit user'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/users/index.php'); ?>">&laquo; Back to List</a>

  
    <h1>Edit user</h1>

    <?php echo display_errors($user->errors); ?>

    <form action="<?php echo url_for('/users/edit.php?id=' . h(u($user_id))); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Edit user" />
      </div>
    </form>



</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>

