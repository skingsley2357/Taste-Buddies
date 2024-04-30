<?php

/**
* Establishes a connection to the database using predefined constants.
* It utilizes the mysqli extension to connect to the database and ensures the connection is successful.
* @return mysqli A mysqli object representing the connection to the database.
*/
function db_connect() {
  $connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  confirm_db_connect($connection);
  return $connection;
}

/**
* Checks the provided database connection for errors.
* If an error exists, the function outputs an error message and terminates the script.
* @param mysqli $connection - The database connection to be checked.
*/
function confirm_db_connect($connection) {
  if($connection->connect_errno) {
    $msg = "Database connection failed: ";
    $msg .= $connection->connect_error;
    $msg .= " (" . $connection->connect_errno . ")";
    exit($msg);
  }
}

/**
* Closes an established database connection.
* It checks if the connection is set before attempting to close it to avoid errors.
* @param mysqli $connection - The database connection to be closed.
*/
function db_disconnect($connection) {
  if(isset($connection)) {
    $connection->close();
  }
}

?>
