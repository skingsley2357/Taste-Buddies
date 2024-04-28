<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($user)) {
  redirect_to(url_for('/users/index.php'));
}
?>

<dl>
  <dt>Email</dt>
  <dd><input type="text" name="user[email]" value="<?php echo h($user->email); ?>"></dd>
</dl>

<dl>
  <dt>User Name</dt>
  <dd><i>User name must contain at least 8 characters</i></dd>
  <dd><input type="text" name="user[user_name]" value="<?php echo h($user->user_name); ?>"></dd>
</dl>

<dl>
  <dt>Password</dt>
  <dd><i>Password must contain at least 8 characters, 
      <br>both upper and lower case letters,
      <br>and at least 1 number and 1 special character</i></dd>
  <dd><input type="password" name="user[password]" value=""></dd>
</dl>

<dl>
  <dt>Confirm Password</dt>
  <dd><input type="password" name="user[confirm_password]" value=""></dd>
</dl>
