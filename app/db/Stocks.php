<?php 

class Stocks extends Database {

  private $conn;

  public function getAllStocks() {
    $this->conn = $this->getConnection();
    $sql = "SELECT * FROM stocks";
    $result = $this->conn->query($sql);
    $stocks = [];
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $stocks[] = $row;
      }
    }
    return $stocks;
  }

  
}