<?php

class User extends DatabaseObject {

  static protected $table_name = "users";
  static protected $db_columns = ['user_id', 'email', 'user_name', 'is_admin', 'hashed_password'];

  public $user_id;
  public $user_name;
  public $email;
  protected $hashed_password;
  public $password;
  public $confirm_password;
  protected $password_required = true;
  public $is_admin;

  public function __construct($args=[]) {
    $this->user_name = $args['user_name'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->confirm_password = $args['confirm_password'] ?? '';
    $this->is_admin = $args['is_admin'] ?? 1; // Default to Generic User
  }

  protected function set_hashed_password() {
    $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
  }

  public function verify_password($password) {
    return password_verify($password, $this->hashed_password);
  }

  public function create() {
    $this->set_hashed_password();
    return parent::create();
  }

  public function update() {
    if($this->password != '') {
      $this->set_hashed_password();
    } else {
      $this->password_required = false;
    }
    return parent::update();
  }

  protected function validate() {
    $this->errors = [];

    if(is_blank($this->email)) {
      $this->errors[] = "Email cannot be blank.";
    } elseif (!has_length($this->email, array('max' => 255))) {
      $this->errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($this->email)) {
      $this->errors[] = "Email must be a valid format.";
    }

    if(is_blank($this->user_name)) {
      $this->errors[] = "user_name cannot be blank.";
    } elseif (!has_length($this->user_name, array('min' => 8, 'max' => 255))) {
      $this->errors[] = "user_name must be between 8 and 255 characters.";
    // } elseif (!has_unique_user_name($this->user_name, $this->id ?? 0)) {
    //   $this->errors[] = "user_name not allowed. Try another.";
    }

    if($this->password_required) {
      if(is_blank($this->password)) {
        $this->errors[] = "Password cannot be blank.";
      } elseif (!has_length($this->password, array('min' => 8))) {
        $this->errors[] = "Password must contain 8 or more characters";
      } elseif (!preg_match('/[A-Z]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 symbol";
      }
  
      if(is_blank($this->confirm_password)) {
        $this->errors[] = "Confirm password cannot be blank.";
      } elseif ($this->password !== $this->confirm_password) {
        $this->errors[] = "Password and confirm password must match.";
      }
    }

    return $this->errors;
  }

  static public function find_by_user_name($user_name) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE user_name='" . self::$database->escape_string($user_name) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public const IS_ADMIN_OPTIONS = [
    1 => 'User',
    2 => 'Admin'
  ];

}

?>
