<?php

class Session {

  private $user_id;
  public $user_name;
  public $is_admin;
  private $last_login;

  public const MAX_LOGIN_AGE = 60*60*24;

  public function __construct() {
    session_start();
    $this->check_stored_login();
  }

  public function login($user) {
    if($user) {
      session_regenerate_id();
      $_SESSION['user_id'] = $user->user_id;
      $this->user_id = $user->user_id;

      $this->user_name = $_SESSION['user_name'] = $user->user_name;
      $this->last_login = $_SESSION['last_login'] = time();
      $this->is_admin = $_SESSION['is_admin'] = $user->is_admin;
    }
    return true;
  }

  public function is_logged_in() {
    // return isset($this->user_id);
    return isset($this->user_id) && $this->last_login_is_recent();
  }
  
  public function is_admin_logged_in() {
   return $this->is_logged_in() && $this->is_admin == 2;
  }

  public function logout() {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    unset($_SESSION['is_admin']);
    unset($_SESSION['last_login']);
    unset($this->user_id);
    unset($this->user_name);
    unset($this->is_admin);
    unset($this->last_login);
    return true;
  }

  private function check_stored_login() {
    if(isset($_SESSION['user_id'])) {
      $this->user_id = $_SESSION['user_id'];
      $this->user_name = $_SESSION['user_name'];
      $this->is_admin = $_SESSION['is_admin'];
      $this->last_login = $_SESSION['last_login'];
    }
  }

  private function last_login_is_recent() {
    if(!isset($this->last_login)) {
      return false;
    } elseif(($this->last_login + self::MAX_LOGIN_AGE) < time()) {
      return false;
    } else {
      return true;
    }
  }

  public function message($msg="") {
    if(!empty($msg)) {
      $_SESSION['message'] = $msg;
      return true;
    } else {
      return $_SESSION['message'] ?? '';
    }
  }

  public function clear_message() {
    unset($_SESSION['message']);
  }

  public function get_user_id() {
    return $this->user_id;
  }

}

?>
