<?php

require_once('../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('index.php'));
}
$user_id = $_GET['id'];
$user = user::find_by_id($user_id);
if($user == false) {
  redirect_to(url_for('index.php'));
}

if(is_post_request()) {

  // Delete user
  $result = $user->delete();
  $_SESSION['message'] = 'The user was deleted successfully.';
  redirect_to(url_for('/users/index.php'));

} else {
  // Display form
}

?>

<?php $page_title = 'Delete user'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/users/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin delete">
    <h1>Delete user</h1>
    <p>Are you sure you want to delete this user?</p>
    <p class="item"><?php echo h($user->user_name()); ?></p>

    <form action="<?php echo url_for('/users/delete.php?id=' . h(u($user_id))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete user" />
      </div>
    </form>
  </div>

</div>



<?php include(SHARED_PATH . '/public_footer.php'); ?>
