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
  // Edit the stock in the database.
  $stocks->editStock($_GET['id'], $_POST['stock_name'], $_POST['stock_price']);
  header('Location: /stock-entry');
  exit();
}