<?php require_once('../../private/initialize.php'); ?>
<?php

require_admin_login();

// var_dump($session->user_level); // Add this line for debugging
// var_dump($session->is_logged_in()); // Add this line for debugging
// Find all users
$users = User::find_all();
  
?>
<?php $page_title = 'Users'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

  <div id="user">
    <h1>Users</h1>

  	<table id="user-table">
      <tr>
        <th>ID</th>
        <th>Email</th>
        <th>user_name</th>
        <?php if ($session->is_admin == 2) : ?>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <?php endif; ?>
      </tr>

      <?php foreach($users as $user) { ?>
        <tr>
          <td><?php echo h($user->user_id); ?></td>
          <td><?php echo h($user->email); ?></td>
          <td><?php echo h($user->user_name); ?></td>
          <?php if ($session->is_admin == 2) : ?>
          <td><a href="<?php echo url_for('/users/show.php?id=' . h(u($user->user_id))); ?>">View</a></td>
          <td><a href="<?php echo url_for('/users/edit.php?id=' . h(u($user->user_id))); ?>">Edit</a></td>
          <td><a href="<?php echo url_for('/users/delete.php?id=' . h(u($user->user_id))); ?>">Delete</a></td>
          <?php endif; ?>
    	  </tr>
      <?php } ?>
  	</table>

  </div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
