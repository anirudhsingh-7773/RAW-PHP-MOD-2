<?php

require_once '../app/db/config.php';
class Database {
    private $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
      try {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
      } catch (Exception $e) {
          echo "<script>alert('" . $e->getMessage() . "');</script>";
          exit;
      }
    }

    public function getConnection() {
        return $this->conn;
    }
}

