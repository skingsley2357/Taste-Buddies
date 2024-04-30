<?php

/**
 * Represents a User entity with properties and methods to manage user data.
 */
class User extends DatabaseObject {

  /**
   * The database table name associated with the User class.
   * @var string
   */
  static protected $table_name = "users";

  /**
   * The database columns to be used with the User class.
   * @var array
   */
  static protected $db_columns = ['user_id', 'email', 'user_name', 'is_admin', 'hashed_password'];

  /**
   * The identifier for the user.
   * @var int
   */
  public $user_id;

  /**
   * The user's name.
   * @var string
   */
  public $user_name;

  /**
   * The user's email.
   * @var string
   */
  public $email;

  /**
   * The hashed password for the user.
   * @var string
   */
  protected $hashed_password;

  /**
   * The plain text password to be hashed.
   * @var string
   */
  public $password;

  /**
   * The confirmation password for validation.
   * @var string
   */
  public $confirm_password;

  /**
   * Indicates if a password is required when updating a user.
   * @var bool
   */
  protected $password_required = true;

  /**
   * Indicates if the user is an admin.
   * @var int
   */
  public $is_admin;

  /**
   * Constructor for the User class.
   * Initializes user properties using an associative array.
   * @param array $args - Associative array of properties to set.
   */
  public function __construct($args=[]) {
    $this->user_name = $args['user_name'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->confirm_password = $args['confirm_password'] ?? '';
    $this->is_admin = $args['is_admin'] ?? 1; // Default to Generic User
  }

  /**
   * Sets the hashed password.
   */
  protected function set_hashed_password() {
    $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
  }

  /**
   * Verifies a given password against the user's hashed password.
   * @param string $password - The password to verify.
   * @return bool - True if the password matches, false otherwise.
   */
  public function verify_password($password) {
    return password_verify($password, $this->hashed_password);
  }

  /**
   * Creates a new user record in the database.
   * @return mixed - The result of the database create operation.
   */
  public function create() {
    $this->set_hashed_password();
    return parent::create();
  }

  /**
   * Updates a user record in the database.
   * @return mixed - The result of the database update operation.
   */
  public function update() {
    if($this->password != '') {
      $this->set_hashed_password();
    } else {
      $this->password_required = false;
    }
    return parent::update();
  }

  /**
   * Validates the user properties.
   * @return array - An array of error messages.
   */
  protected function validate() {
    $this->errors = [];

    if(is_blank($this->email)) {
      $this->errors[] = "Email cannot be blank.";
    } elseif (!has_length($this->email, array('max' => 255))) {
      $this->errors[] = "Email must be less than 255 characters.";
    } elseif (!has_valid_email_format($this->email)) {
      $this->errors[] = "Email must be a valid format.";
    }

    if(is_blank($this->user_name)) {
      $this->errors[] = "User name cannot be blank.";
    } elseif (!has_length($this->user_name, array('min' => 8, 'max' => 255))) {
      $this->errors[] = "User name must be between 8 and 255 characters.";
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

  /**
   * Finds a user by user name.
   * @param string $user_name - The user name to search for.
   * @return mixed - User object if found, false otherwise.
   */
  static public function find_by_user_name($user_name) {
    $sql = "SELECT * FROM " . static::$table_name . " WHERE user_name='" . self::$database->escape_string($user_name) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

}

?>
