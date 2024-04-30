<?php

/**
 * Checks if the user is logged in, redirecting to the login page if not.
 * This function should be called on pages that require a user to be logged in.
 */
function require_login() {
  global $session;
  if(!$session->is_logged_in()) {
    redirect_to(url_for('login.php'));
  } else {
    // Do nothing, let the rest of the page proceed
  }
}

/**
 * Checks if the admin user is logged in, redirecting to the login page if not.
 * This function should be used on pages that require an administrative user to be logged in.
 */
function require_admin_login() {
  global $session;
  if(!$session->is_admin_logged_in()) {
    redirect_to(url_for('login.php'));
  } else {
    // Do nothing, let the rest of the page proceed
  }
}

/**
 * Displays formatted error messages.
 * Takes an array of error strings and returns them formatted as HTML.
 * @param array $errors - An array of error messages to display.
 * @return string - A formatted string of error messages wrapped in HTML.
 */
function display_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    $output .= "<div class=\"errors\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";
    foreach($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}

/**
 * Retrieves and clears a message stored in the session.
 * This function is used to pass messages (like success or error notifications) across pages.
 * @return string|null - The message from the session or null if there isn't one.
 */
function get_and_clear_session_message() {
  if(isset($_SESSION['message']) && $_SESSION['message'] != '') {
    $msg = $_SESSION['message'];
    unset($_SESSION['message']);
    return $msg;
  }
}

/**
 * Displays and clears a session message.
 * This function calls get_and_clear_session_message() to retrieve and clear the session message,
 * then it formats the message for display if one exists.
 * @return string - The formatted session message wrapped in HTML.
 */
function display_session_message() {
  $msg = get_and_clear_session_message();
  if(isset($msg) && $msg != '') {
    return '<div id="message">' . h($msg) . '</div>';
  }
}

?>
