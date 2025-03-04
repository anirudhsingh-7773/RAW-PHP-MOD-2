<?php

/**
 * Class App
 * 
 * Handles the routing.
 */
class App {

  /**
   * Splits the url into array.
   * 
   * @return bool|string[]
   */
  private function splitURL() {
    // Get the 'url' parameter from the query string.
    // If not set, default is 'Home'.
    $URL = $_GET['url'] ?? 'Home';

    // Remove leading slashes.
    $URL = ltrim($URL,"/");

    // Split URL by slashes.
    $URL = explode("/", $URL);
    return $URL;
  }

  /**
   * Loads the required php file based on URL.
   * 
   * @return void
   */
  public function loadURL() {
    // Gets the URL array.
    $URL = $this->splitURL();
    
    // Set the file path.
    $filepath = "../app/php/" . ucfirst($URL[0]) . ".php";

    // Check if the URL length is greater than 1.
    if (count($URL) > 1) {
      // Show 404 page.
      require_once "../app/Dashboard/404.php";
    } // check if the file exists.
    else if (file_exists($filepath)) {
      // Loads the required file.
      require_once $filepath;
    } 
    else {
      // Show 404 page.
      require_once "../app/Dashboard/404.php";
    }
  }
}
