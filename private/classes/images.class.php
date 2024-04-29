<?php

class Images extends  DatabaseObject {

  static protected $table_name = 'images';
  static protected $db_columns = ['image_id', 'recipe_id', 'file_path'];
  
  public $image_id;
  public $recipe_id;
  public $file_path;

  public function __construct($args = []) {
    $this->image_id = $args['image_id'] ?? '';
    $this->recipe_id = $args['recipe_id'] ?? '';
    $this->file_path = $args['file_path'] ?? '';
  }

  public function create_image() {
    $sql = "INSERT INTO images (";
    $sql .= "image_id, recipe_id, file_path";
    $sql .= ") VALUES (";
    $sql .= "'" . $this->image_id . "', ";
    $sql .= "'" . $this->recipe_id . "', ";
    $sql .= "'" . $this->file_path . "'";
    $sql .= ")";
    $result = self::$database->query($sql);
    return $result;
  }

  public static function handle_file_upload($file, $recipe_id) {
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (!in_array($fileActualExt, $allowed)) {
        return "You cannot upload files of this type!";
    }

    if ($fileError !== 0) {
        return "There was an error uploading your file!";
    }

    if ($fileSize > 500000) {
        return "Your file is too big!";
    }

    $fileNameNew = $recipe_id . "." . $fileActualExt;
    $fileDestination = $_SERVER['DOCUMENT_ROOT'] . '/TasteBuddies/public/uploads/' . $fileNameNew;
    if (!is_dir($_SERVER['DOCUMENT_ROOT'] . '/TasteBuddies/public/uploads')) {
      mkdir($_SERVER['DOCUMENT_ROOT'] . '/TasteBuddies/public/uploads', 0777, true);
  }

  if (move_uploaded_file($fileTmpName, $fileDestination)) {
      // Save the file path in the database
      global $database; // Make sure $database is accessible or use a database connection
      $sql = "INSERT INTO images (recipe_id, file_path) VALUES (?, ?)";
      $stmt = $database->prepare($sql);
      $stmt->bind_param("is", $recipe_id, $fileNameNew);  // Store only the file name or a better-resolved path
      if ($stmt->execute()) {
          return true;
      } else {
          return "Error storing file information in the database.";
      }
  } else {
      return "Failed to move the uploaded file. Error: " . json_encode(error_get_last());
  }

}
}
?>
