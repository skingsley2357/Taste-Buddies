<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($user)) {
  redirect_to(url_for('/users/index.php'));
}
?>

<dl>
  <dt>Email</dt>
  <dd><input type="text" name="user[email]" value="<?php echo h($user->email); ?>" /></dd>
</dl>

<dl>
  <dt>User Name</dt>
  <dd><input type="text" name="user[user_name]" value="<?php echo h($user->user_name); ?>" /></dd>
</dl>

<dl>
  <dt>User Level</dt>
  <dd>
    <select name="user[is_admin]">
      <option value=""></option>
    <?php foreach(user::IS_ADMIN_OPTIONS as $level_id => $level_name) { ?>
      <option value="<?php echo $level_id; ?>" <?php if($user->is_admin == $level_id) { echo 'selected'; } ?>><?php echo $level_name; ?></option>
    <?php } ?>
    </select>
  </dd>
</dl>

<dl>
  <dt>Password</dt>
  <dd><input type="password" name="user[password]" value="" /></dd>
</dl>

<dl>
  <dt>Confirm Password</dt>
  <dd><input type="password" name="user[confirm_password]" value="" /></dd>
</dl>
