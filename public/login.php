<?php
require_once('../private/initialize.php');

$errors = [];
$user_name = '';
$password = '';

if(is_post_request()) {

  $user_name = $_POST['user_name'] ?? '';
  $password = $_POST['password'] ?? '';

  // Validations
  if(is_blank($user_name)) {
    $errors[] = "Username cannot be blank.";
  }
  if(is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

  // if there were no errors, try to login
  if(empty($errors)) {
    $user = user::find_by_user_name($user_name);
    // test if user found and password is correct
    if($user != false && $user->verify_password($password)) {
      // Mark user as logged in
      $session->login($user);
      redirect_to(url_for('/recipes/new.php'));
    } else {
      // user_name not found or password does not match
      $errors[] = "Log in was unsuccessful.";
    }

  }

}

?>

<?php $page_title = 'Log in'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="content">
  <h1>Log in</h1>

  <?php echo display_errors($errors); ?>

  <form action="login.php" method="post">
    User Name:<br />
    <input type="text" name="user_name" value="<?php echo h($user_name); ?>" /><br />
    Password:<br />
    <input type="password" name="password" value="" /><br />
    <input type="submit" name="submit" value="Submit"  />
  </form>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
