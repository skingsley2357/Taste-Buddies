<!doctype html>

<html lang="en">
  <head>
    <title>Taste Buddies <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/css/style.css'); ?>" />
  </head>

  <body>

    <header>
      <h1>Taste Buddies</h1>
      <nav>
        <ul>
          <li><a href="<?php echo url_for('index.php'); ?>">Home</a></li>
          <li><a href="<?php echo url_for('about_us.php'); ?>">About Us</a></li>
          <?php if($session->is_logged_in()) { ?>
            <li><a href="<?php echo url_for('logout.php'); ?>">Logout</a></li>
          <?php } else { ?>
            <li><a href="<?php echo url_for('login.php'); ?>">Log In</a></li>
            <li><a href="<?php echo url_for('users/new.php'); ?>">Sign Up</a></li>
          <?php }?>
        </ul>
      </nav>

        <?php if($session->is_logged_in()) { ?>
          <h2>User: <?php echo $session->user_name; ?><h2>
        <?php } ?>
    </header>
