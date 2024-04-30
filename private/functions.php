<?php

/**
 * Constructs a full URL path for a given script within the application.
 * Adds a leading '/' if not present and prepends the WWW_ROOT global path.
 * @param string $script_path - The path to the script.
 * @return string - The fully qualified URL path.
 */
function url_for($script_path) {
  // add the leading '/' if not present
  if($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

/**
 * Encodes a string for use in a query part of a URL.
 * @param string $string - The string to encode.
 * @return string - The URL-encoded string.
 */
function u($string="") {
  return urlencode($string);
}

/**
 * Encodes a string according to RFC 3986 for a URL.
 * @param string $string - The string to encode.
 * @return string - The URL-encoded string using rawurlencode.
 */
function raw_u($string="") {
  return rawurlencode($string);
}

/**
 * Converts special characters to HTML entities to prevent XSS attacks.
 * @param string $string - The string to escape.
 * @return string - The escaped string.
 */
function h($string="") {
  return htmlspecialchars($string);
}

/**
 * Sends a 404 Not Found header and terminates the script.
 */
function error_404() {
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}

/**
 * Sends a 500 Internal Server Error header and terminates the script.
 */
function error_500() {
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  exit();
}

/**
 * Redirects to the specified location using a header redirect.
 * @param string $location - The URL to redirect to.
 */
function redirect_to($location) {
  header("Location: " . $location);
  exit;
}

/**
 * Checks if the current request is a POST request.
 * @return bool - True if the request method is POST, otherwise false.
 */
function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

/**
 * Checks if the current request is a GET request.
 * @return bool - True if the request method is GET, otherwise false.
 */
function is_get_request() {
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

// PHP on Windows does not have a money_format() function.
// This is a super-simple replacement.
if (!function_exists('money_format')) {
  /**
   * Formats a number as a currency string.
   * Provides a basic replacement for the `money_format` function which is not available on Windows.
   * @param string $format - The format string (unused in this simple implementation).
   * @param float $number - The number to format.
   * @return string - The formatted number as a string with two decimal places and a leading dollar sign.
   */
  function money_format($format, $number) {
    return '$' . number_format($number, 2);
  }
}

?>
