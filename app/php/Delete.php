<?php 

/**
 * Class Delete
 * 
 * Delete a stock from the database.
 */
class Delete {
  
  /**
   * Delete constructor
   * 
   * Delete a stock from the database.
   */
  public function __construct() {
    require_once '../app/db/Stocks.php';
    $stocks = new Stocks();

    // Deletes the stock.
    $stocks->deleteStock($_GET['id']);

    header('Location: /home');
    exit();
  }
}

// Instantiates the Delete class.
$delete = new Delete();