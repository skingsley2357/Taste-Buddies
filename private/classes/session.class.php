<?php

/**
 * Manages user sessions for login and access control within the application.
 */
class Session {

  /**
   * The user's ID from the database.
   * @var int
   */
  public $user_id;

  /**
   * The user's name.
   * @var string
   */
  public $user_name;

  /**
   * Flag to determine if the user is an admin.
   * @var bool
   */
  public $is_admin;

  /**
   * Timestamp of the last login.
   * @var int
   */
  private $last_login;

  /**
   * Maximum age of a login session in seconds before it becomes invalid.
   * @const int
   */
  public const MAX_LOGIN_AGE = 60*60*24;  // 24 hours

  /**
   * Constructor that starts the session and checks for a stored login.
   */
  public function __construct() {
    session_start();
    $this->check_stored_login();
  }

  /**
   * Logs in a user by setting session variables.
   * @param object $user - The user object containing user details.
   * @return bool - Always returns true.
   */
  public function login($user) {
    if($user) {
      session_regenerate_id();
      $_SESSION['user_id'] = $user->user_id;
      $this->user_id = $user->user_id;

      $_SESSION['user_name'] = $user->user_name;
      $this->user_name = $user->user_name;
      $_SESSION['last_login'] = time();
      $this->last_login = $_SESSION['last_login'];
      $_SESSION['is_admin'] = $user->is_admin;
      $this->is_admin = $user->is_admin;
    }
    return true;
  }

  /**
   * Checks if a user is logged in and the session is recent.
   * @return bool - True if user is logged in and session is recent, otherwise false.
   */
  public function is_logged_in() {
    return isset($this->user_id) && $this->last_login_is_recent();
  }

  /**
   * Checks if an admin user is logged in.
   * @return bool - True if an admin is logged in, otherwise false.
   */
  public function is_admin_logged_in() {
    return $this->is_logged_in() && $this->is_admin == 2;
  }

  /**
   * Logs out a user by unsetting all session and object properties.
   * @return bool - Always returns true.
   */
  public function logout() {
    unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['is_admin'], $_SESSION['last_login']);
    unset($this->user_id, $this->user_name, $this->is_admin, $this->last_login);
    return true;
  }

  /**
   * Checks if login details are stored in the session and sets object properties.
   */
  private function check_stored_login() {
    if(isset($_SESSION['user_id'])) {
      $this->user_id = $_SESSION['user_id'];
      $this->user_name = $_SESSION['user_name'];
      $this->is_admin = $_SESSION['is_admin'];
      $this->last_login = $_SESSION['last_login'];
    }
  }

  /**
   * Checks if the last login is recent based on the MAX_LOGIN_AGE.
   * @return bool - True if the last login is within the maximum login age, otherwise false.
   */
  private function last_login_is_recent() {
    if (!isset($this->last_login)) {
      return false;
    } elseif (($this->last_login + self::MAX_LOGIN_AGE) < time()) {
      return false;
    } else {
      return true;
    }
  }

  /**
   * Sets or gets a message in the session.
   * @param string $msg - The message to set in the session.
   * @return mixed - True if setting a message, or the message if getting.
   */
  public function message($msg="") {
    if(!empty($msg)) {
      $_SESSION['message'] = $msg;
      return true;
    } else {
      return $_SESSION['message'] ?? '';
    }
  }

  /**
   * Clears a message from the session.
   */
  public function clear_message() {
    unset($_SESSION['message']);
  }

  /**
   * Retrieves the user ID.
   * @return int - The user ID.
   */
  public function get_user_id() {
    return $this->user_id;
  }

}

?>
