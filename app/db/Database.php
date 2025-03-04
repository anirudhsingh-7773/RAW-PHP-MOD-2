<?php

// Require the database configuration file.
require_once '../app/db/config.php';

/**
 * class Database
 * 
 * Handles the database connection.
 */
class Database {

  /**
   * Database connection
   * @var 
   */
  private $conn;

  /**
   * Constructor, connect to the database.
   */
  public function __construct() {
      $this->connect();
  }

  /**
   * Connect to the database
   */
  private function connect() {
    // Handling errors.
    try {
      // Create a new connection.
      $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    } catch (Exception $e) {
        echo "<script>alert('" . $e->getMessage() . "');</script>";
        exit;
    }
  }

  /**
   * Get the connection
   * 
   * @return 
   */
  public function getConnection() {
    return $this->conn;
  }
}
