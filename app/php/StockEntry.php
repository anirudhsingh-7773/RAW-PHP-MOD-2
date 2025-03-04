<?php 

/**
 * Class StockEntry
 * 
 * Handles the stock entry.
 */
class StockEntry {
  /**
   * StockEntry constructor, loads the stock entry view.
   */
  public function __construct() {
    require_once '../app/Dashboard/stock-entry.view.php';
  }
}

// Create an instance of StockEntry.
$userStocks = new StockEntry();

// Check if the request method is POST.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require_once '../app/db/Stocks.php';
  $stocks = new Stocks();
  // Add the stock to the database.
  $stocks->addStock($_POST['stock_name'], $_POST['stock_price'], $_SESSION['user']);
  header('Location: /stock-entry');
  exit();
}
