<?php 

/**
 * Class Edit
 * 
 * Handles the stock details edit form.
 */
class Edit {
  
  /**
   * Edit constructor, loads the edit stock view.
   */
  public function __construct() {
    require_once '../app/Dashboard/edit-stock.php';
  }
}

// Create an instance of Edit.
$edit = new Edit();

// Check if the request method is POST.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $stocks = new Stocks();
  $stock = $stocks->getStock($_GET['id']);
  $stockname = $stock['stock_name'];
  $stockprice = $stock['stock_price'];

  // Check if the stock name or price is empty.
  if (!empty($_POST['stock_name'])) {
    $stockname = $_POST['stock_name'];
  }
  if (!empty($_POST['stock_price'])) {
    $stockprice = $_POST['stock_price'];
  }

  // Edit the stock in the database.
  $stocks->editStock($_GET['id'], $stockname, $stockprice);
  header('Location: /stock-entry');
  exit();
}
