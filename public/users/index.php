<?php require_once('../../private/initialize.php'); ?>
<?php

// var_dump($session->user_level); // Add this line for debugging
// var_dump($session->is_logged_in()); // Add this line for debugging
// Find all users
$users = User::find_all();
  
?>
<?php $page_title = 'Users'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>


<div id="content">
  <div class="admins listing">
    <h1>users</h1>

    <?php if ($session->is_admin == 2) : ?>
    <div class="actions">
      <a class="action" href="<?php echo url_for('/users/new.php'); ?>">Add user</a>
    </div>
    <?php endif; ?>

  	<table class="list">
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
          <td><a class="action" href="<?php echo url_for('/users/show.php?id=' . h(u($user->user_id))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/users/edit.php?id=' . h(u($user->user_id))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/users/delete.php?id=' . h(u($user->user_id))); ?>">Delete</a></td>
          <?php endif; ?>
    	  </tr>
      <?php } ?>
  	</table>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
