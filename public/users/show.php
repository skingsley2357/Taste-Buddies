<?php require_once('../../private/initialize.php'); ?>

<?php

require_login();

$user_id = $_GET['id'] ?? '1'; // PHP > 7.0

$user = User::find_by_id($user_id);
var_dump($_GET);
?>

<?php $page_title = 'Show user: ' . h($user->user_name); ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/users/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin show">

    <h1>user: <?php echo h($user->user_name); ?></h1>

    <div class="attributes">
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($user->email); ?></dd>
      </dl>
      <dl>
        <dt>Username</dt>
        <dd><?php echo h($user->user_name); ?></dd>
      </dl>
    </div>

  </div>

</div>
