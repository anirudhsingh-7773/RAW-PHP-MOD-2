<?php 

require_once 'Database.php';

/**
 * Class Stocks
 * 
 * Handles all stock related database operations.
 */
class Stocks extends Database {

  /**
   * Database connection.
   * 
   * @var mysqli
   */
  private $conn;

  /**
   * Returns all stocks from the database.
   * @return array<array|bool|null>
   */
  public function getAllStocks() {
    $this->conn = $this->getConnection();
    $sql = "SELECT * FROM stocks";
    $result = $this->conn->query($sql);
    $stocks = [];
    // Stores the stocks in an array.
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $stocks[] = $row;
      }
    }
    return $stocks;
  }

  /**
   * Returns all stocks created by a user.
   * 
   * @param string $username
   * @return array<array|bool|null>
   */
  public function getStockByUser($username) {
    $this->conn = $this->getConnection();
    $sql = "SELECT * FROM stocks WHERE created_by = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $stocks = [];
    // Stores the stocks in an array.
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $stocks[] = $row;
      }
    }
    return $stocks;
  }

  /**
   * Returns a stock by its ID.
   * 
   * @param int $id
   * @return array|bool|null
   */
  public function getStock($id) {
    $this->conn = $this->getConnection();
    $sql = "SELECT * FROM stocks WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stock = $result->fetch_assoc();
    return $stock;
  }

  /**
   * Deletes a stock from the database.
   * 
   * @param int $id
   */
  public function deleteStock($id) {
    $this->conn = $this->getConnection();
    $sql = "DELETE FROM stocks WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
  }

  /**
   * Edits a stock in the database.
   * 
   * @param int $id
   * @param string $stock_name
   * @param float $stock_price
   */
  public function editStock($id, $stock_name, $stock_price) {
    $this->conn = $this->getConnection();
    $sql = "UPDATE stocks SET stock_name = ?, stock_price = ? WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("sdi", $stock_name, $stock_price, $id);
    $stmt->execute();
    $stmt->close();
  }

  /**
   * Adds a stock to the database.
   * 
   * @param string $stock_name
   * @param float $stock_price
   * @param string $created_by
   */
  public function addStock($stock_name, $stock_price, $created_by) {
    $this->conn = $this->getConnection();
    $sql = "INSERT INTO stocks (stock_name, stock_price, created_by) VALUES (?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("sis", $stock_name, $stock_price, $created_by);
    $stmt->execute();
    $stmt->close();
  }
}
