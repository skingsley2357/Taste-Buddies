<?php

class DatabaseObject {

  static protected $database;
  static protected $table_name = "";
  static protected $columns = [];
  public $errors = [];

  static public function set_database($database) {
    self::$database = $database;
  }

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

  static public function find_all() {
    $sql = "SELECT * FROM " . static::$table_name;
    return static::find_by_sql($sql);
  }

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

  static protected function instantiate($record) {
    $object = new static; // Creates a new instance without using constructor arguments.
    foreach($record as $property => $value) {
        if(property_exists($object, $property)) {
            $object->$property = $value; // Set properties directly based on database fields.
        }
    }
    return $object;
  }

  protected function validate() {
    $this->errors = [];

    // Add custom validations

    return $this->errors;
  }

  protected function create() {
    $this->validate();
    if(!empty($this->errors)) { return false; }

    $attributes = $this->sanitized_attributes();

    $sql = "INSERT INTO " . static::$table_name . " (";
    $sql .= join(', ', array_keys($attributes));
    $sql .= ") VALUES ('";
    $sql .= join("', '", array_values($attributes));
    $sql .= "')";
    
    $result = self::$database->query($sql);
    if($result) {
      $this->id = self::$database->insert_id;
    }
    return $result;
  }

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
    if($result) {
      $this->id = self::$database->insert_id;
    }
    return $result;
  }

  protected function update() {
    $this->validate();
    if(!empty($this->errors)) { return false; }

    $attributes = $this->sanitized_attributes();
    $attribute_pairs = [];
    foreach($attributes as $key => $value) {
      $attribute_pairs[] = "{$key}='{$value}'";
    }

    $sql = "UPDATE " . static::$table_name . " SET ";
    $sql .= join(', ', $attribute_pairs);
    $sql .= " WHERE user_id='" . self::$database->escape_string($this->user_id) . "' ";
    $sql .= "LIMIT 1";
    $result = self::$database->query($sql);
    return $result;
  }

  public function save() {
    if(isset($this->id)) {
        return $this->update();
    } else {
        return $this->create();
    }
}

public function valid_meal_type($meal_type_id) {
    $sql = "SELECT 1 FROM meal_type WHERE meal_id = ?";
    $stmt = self::$database->prepare($sql);
    $stmt->bind_param("i", $meal_type_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows === 1;
}

  public function merge_attributes($args=[]) {
    foreach($args as $key => $value) {
      if(property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }

  // Properties which have database columns, excluding ID
  public function attributes() {
    $attributes = [];
    foreach(static::$db_columns as $column) {
      if($column == 'user_id') { continue; }
      $attributes[$column] = $this->$column;
    }
    return $attributes;
  }

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

  public function delete() {
    $sql = "DELETE FROM " . static::$table_name . " ";
    $sql .= "WHERE user_id='" . self::$database->escape_string($this->user_id) . "' ";
    $sql .= "LIMIT 1";
    $result = self::$database->query($sql);
    return $result;
  }

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
