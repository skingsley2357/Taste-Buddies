<?php

/**
 * Represents an Images entity with properties and methods to manage image data associated with recipes.
 */
class Images extends DatabaseObject {

  /**
   * The database table name associated with the Images class.
   * @var string
   */
  static protected $table_name = 'images';

  /**
   * The database columns to be used with the Images class.
   * @var array
   */
  static protected $db_columns = ['image_id', 'recipe_id', 'file_path'];
  
  /**
   * The identifier for the image.
   * @var int
   */
  public $image_id;

  /**
   * The associated recipe identifier.
   * @var int
   */
  public $recipe_id;

  /**
   * The file path of the image.
   * @var string
   */
  public $file_path;

  /**
   * Constructor for the Images class.
   * Initializes the image properties using an associative array.
   * @param array $args - Associative array of properties to set.
   */
  public function __construct($args = []) {
    $this->image_id = $args['image_id'] ?? '';
    $this->recipe_id = $args['recipe_id'] ?? '';
    $this->file_path = $args['file_path'] ?? '';
  }

  /**
   * Inserts a new image record into the database.
   * @return bool - True on success, false on failure.
   */
  public function create_image() {
    $sql = "INSERT INTO images (image_id, recipe_id, file_path) VALUES ('" . $this->image_id . "', '" . $this->recipe_id . "', '" . $this->file_path . "')";
    $result = self::$database->query($sql);
    return $result;
  }

  /**
   * Handles the file upload process, checks for errors, validates file type and size, and stores the file.
   * @param array $file - The $_FILES array containing the file information.
   * @param int $recipe_id - The associated recipe ID.
   * @return mixed - True on success, error message string on failure.
   */
  public static function handle_file_upload($file, $recipe_id) {
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = ['jpg', 'jpeg', 'png'];

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
      global $database; // Make sure $database is accessible or use a database connection
      $sql = "INSERT INTO images (recipe_id, file_path) VALUES (?, ?)";
      $stmt = $database->prepare($sql);
      $stmt->bind_param("is", $recipe_id, $fileNameNew);
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
