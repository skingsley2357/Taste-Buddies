<!doctype html>

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>Taste Buddies <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <link rel="stylesheet" media="all" href="<?php echo url_for('/css/style.css'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

  <body>

    <header>
      <h1>Taste Buddies</h1>
      <nav>
        <ul>
          <li><a href="<?php echo url_for('/index.php'); ?>">Home</a></li>
          <li><a href="<?php echo url_for('/about_us.php'); ?>">About Us</a></li>
          <?php if($session->is_logged_in()) { ?>
            <li><a href="<?php echo url_for('/logout.php'); ?>">Logout, <?php echo $session->user_name; ?></a></li>
          <?php } else { ?>
            <li><a href="<?php echo url_for('/login.php'); ?>">Log In</a></li>
            <li><a href="<?php echo url_for('/users/new.php'); ?>">Sign Up</a></li>
          <?php }?>
          <?php if ($session->is_admin == 2) : ?>
            <li><a href="<?php echo url_for('/users/index.php'); ?>">Users</a></li>
          <?php endif ?>
        </ul>
      </nav>

    </header>
