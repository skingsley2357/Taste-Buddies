<?php

class DatabaseObject {

  static protected $database;
  static protected $table_name = "";
  static protected $columns = [];
  public $errors = [];

  /**
   * Sets the database connection for all instances of this class.
   * @param mysqli $database The database connection.
   */
  static public function set_database($database) {
    self::$database = $database;
  }

  /**
   * Executes a SQL query and returns an array of object instances populated by the query results.
   * @param string $sql The SQL query string.
   * @return array An array of instances of the calling class.
   */
  static public function find_by_sql($sql) {
    $result = self::$database->query($sql);
    if(!$result) {
      exit("Database query failed.");
    }

    // results into objects
    $object_array = [];
    while($record = $result->fetch_assoc()) {
      $object_array[] = static::instantiate($record);
    }

    $result->free();

    return $object_array;
  }

  /**
   * Fetches all records from the database and returns an array of instances.
   * @return array An array of instances of the calling class.
   */
  static public function find_all() {
    $sql = "SELECT * FROM " . static::$table_name;
    return static::find_by_sql($sql);
  }

  /**
   * Fetches a single record from the database by user_id.
   * @param int $user_id The user ID to search for.
   * @return mixed An instance of the calling class populated with the database row, or false if not found.
   */
  static public function find_by_id($user_id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE user_id='" . self::$database->escape_string($user_id) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_by_recipe($recipe_id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE recipe_id='" . self::$database->escape_string($recipe_id) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static function find_all_by_recipe($recipe_id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE recipe_id='" . self::$database->escape_string($recipe_id) . "'";
    $obj_array = static::find_by_sql($sql);
    return $obj_array; // Return the entire array of objects
  }

  /**
   * Instantiates an object and sets properties based on a database row.
   * @param array $record An associative array of database row values.
   * @return self An instance of the class with properties set.
   */
  static protected function instantiate($record) {
    $object = new static; // Creates a new instance without using constructor arguments.
    foreach($record as $property => $value) {
        if(property_exists($object, $property)) {
            $object->$property = $value; // Set properties directly based on database fields.
        }
    }
    return $object;
  }

  /**
 * Validates the instance properties and sets any errors encountered during the validation process.
 * @return array An array of error messages.
 */
protected function validate() {
  $this->errors = [];

  // Custom validations should be implemented here.

  return $this->errors;
}

/**
* Creates a new record in the database using attributes of this object.
* @return bool True if the creation was successful, false otherwise.
*/
public function create() {
  $this->validate();
  if (!empty($this->errors)) { return false; }

  $attributes = $this->sanitized_attributes();
  $sql = "INSERT INTO " . static::$table_name . " (";
  $sql .= join(', ', array_keys($attributes));
  $sql .= ") VALUES ('";
  $sql .= join("', '", array_values($attributes));
  $sql .= "')";
  
  $result = self::$database->query($sql);
  if ($result) {
      $this->id = self::$database->insert_id;
  }
  return $result;
}

/**
* Updates the current object's database record.
* @return bool True if the update was successful, false otherwise.
*/
public function update() {
  $this->validate();
  if (!empty($this->errors)) { return false; }

  $attributes = $this->sanitized_attributes();
  $attribute_pairs = [];
  foreach ($attributes as $key => $value) {
      $attribute_pairs[] = "{$key}='{$value}'";
  }

  $sql = "UPDATE " . static::$table_name . " SET ";
  $sql .= join(', ', $attribute_pairs);
  $sql .= " WHERE user_id='" . self::$database->escape_string($this->user_id) . "' LIMIT 1";
  $result = self::$database->query($sql);
  return $result;
}

/**
* Saves the current object: updates if an ID exists, otherwise creates a new record.
* @return bool True if the save was successful, false otherwise.
*/
public function save() {
  if (isset($this->id)) {
      return $this->update();
  } else {
      return $this->create();
  }
}

/**
* Creates a new recipe in the database using the recipe-related attributes of this object.
* @return bool True if the creation was successful, false otherwise.
*/
public function create_recipe() {
  $sql = "INSERT INTO recipes (";
  $sql .= "recipe_id, user_id, recipe_name, instructions, cooking_time, difficulty, cuisine_type, meal_type";
  $sql .= ") VALUES (";
  $sql .= "'" . $this->recipe_id . "', ";
  $sql .= "'" . $this->user_id . "', ";
  $sql .= "'" . $this->recipe_name . "', ";
  $sql .= "'" . $this->instructions . "', ";
  $sql .= "'" . $this->cooking_time . "', ";
  $sql .= "'" . $this->difficulty . "', ";
  $sql .= "'" . $this->cuisine_type . "', ";
  $sql .= "'" . $this->meal_type . "'";
  $sql .= ")";
  $result = self::$database->query($sql);
  if ($result) {
      $this->id = self::$database->insert_id;
  }
  return $result;
}

/**
* Updates the recipe associated with this object in the database.
* @return bool True if the update was successful, false otherwise.
*/
public function update_recipe() {
  $this->validate();
  if (!empty($this->errors)) { return false; }

  $attributes = $this->sanitized_attributes();
  $attribute_pairs = [];
  foreach ($attributes as $key => $value) {
      $attribute_pairs[] = "{$key}='{$value}'";
  }

  $sql = "UPDATE " . static::$table_name . " SET ";
  $sql .= join(', ', $attribute_pairs);
  $sql .= " WHERE recipe_id='" . self::$database->escape_string($this->recipe_id) . "' LIMIT 1";
  $result = self::$database->query($sql);
  return $result;
}

/**
* Saves the recipe object: updates if an ID exists, otherwise creates a new record.
* @return bool True if the save was successful, false otherwise.
*/
public function save_recipe() {
  if (isset($this->id)) {
      return $this->update_recipe();
  } else {
      return $this->create_recipe();
  }
}

/**
* Validates a meal type ID by checking its existence in the database.
* @param int $meal_type_id The ID of the meal type to validate.
* @return bool True if the meal type ID exists, false otherwise.
*/
public function valid_meal_type($meal_type_id) {
  $sql = "SELECT 1 FROM meal_type WHERE meal_id = ?";
  $stmt = self::$database->prepare($sql);
  $stmt->bind_param("i", $meal_type_id);
  $stmt->execute();
  $result = $stmt->get_result();
  return $result->num_rows === 1;
}

/**
* Merges provided attributes into the current object.
* @param array $args Associative array of properties to set.
*/
public function merge_attributes($args=[]) {
  foreach ($args as $key => $value) {
      if (property_exists($this, $key) && !is_null($value)) {
          $this->$key = $value;
      }
  }
}

/**
* Returns an associative array of all object properties that correspond directly to database columns, excluding any ID columns.
* @return array An associative array of database attributes.
*/
public function attributes() {
  $attributes = [];
  foreach (static::$db_columns as $column) {
      if ($column == 'user_id') { continue; }
      $attributes[$column] = $this->$column;
  }
  return $attributes;
}

  /**
   * Sanitizes attributes before sending them to the database.
   * @return array An associative array of sanitized values.
   */
  public function sanitized_attributes() {
    $sanitized = [];
    foreach ($this->attributes() as $key => $value) {
        if (is_array($value)) {
            // Process each element in the array
            foreach ($value as $index => $item) {
                $sanitized[$key][$index] = self::$database->escape_string($item);
            }
        } else {
            $sanitized[$key] = self::$database->escape_string($value);
        }
    }
    return $sanitized;
}

  /**
   * Deletes the record associated with this object's user_id from the database.
   * @return bool True if the deletion was successful, otherwise false.
   */
  public function delete() {
    $sql = "DELETE FROM " . static::$table_name . " ";
    $sql .= "WHERE user_id='" . self::$database->escape_string($this->user_id) . "' ";
    $sql .= "LIMIT 1";
    $result = self::$database->query($sql);
    return $result;
  }

  /**
   * Deletes related images from the 'images' table by recipe_id.
   * @param int $recipe_id The ID of the recipe.
   * @return bool True if the deletion was successful, otherwise false.
   */
  function delete_related_images($recipe_id) {
    global $database;  // Assuming $database is your database connection object
    $query = "DELETE FROM images WHERE recipe_id = ?";
    $stmt = $database->prepare($query);
    if ($stmt) {
        $stmt->bind_param('i', $recipe_id);  // 'i' denotes the variable type is integer
        $stmt->execute();
        $stmt->close();
        return true;
    } else {
        return false;  // Handle errors appropriately
    }
  }
  
   /**
   * Deletes the recipe associated with this object's recipe_id from the database.
   * @return bool True if the deletion was successful, otherwise false.
   */
  public function delete_recipe() {
    $sql = "DELETE FROM " . static::$table_name . " ";
    $sql .= "WHERE recipe_id='" . self::$database->escape_string($this->recipe_id) . "' ";
    $sql .= "LIMIT 1";
    $result = self::$database->query($sql);
    return $result;
  }

   /**
   * Retrieves the ingredient ID by name from the 'ingredient_name' table.
   * @param string $ingredient_name The name of the ingredient.
   * @return int|null The ingredient ID if found, otherwise null.
   */
  function get_ingredient_id_by_name($ingredient_name) {
    global $database;  // Your database connection variable
    $sql = "SELECT Ingredient_name_id FROM ingredient_name WHERE name = ?";
    $stmt = $database->prepare($sql);
    $stmt->bind_param("s", $ingredient_name);
    $stmt->execute();
    $result = $stmt->get_result();
    if($row = $result->fetch_assoc()) {
        return $row['Ingredient_name_id'];
    } else {
        return null;
    }
  }

}

?>
