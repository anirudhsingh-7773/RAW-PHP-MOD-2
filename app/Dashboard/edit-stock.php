<?php
require_once '../app/db/Stocks.php';
$stocks = new Stocks();

// Get the stock by id.
$stock = $stocks->getStock($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      
    }

    h1 {
      margin: 1rem;
    }

    p {
      margin: 1rem;
    }

    form {
      display: flex;
      flex-direction: column;
      width: 50%;
      margin: 1rem;
    }

    input {
      margin: 0.5rem;
      padding: 0.5rem;
    }

    button {
      margin: 0.5rem;
      padding: 0.5rem;
      background-color: red;
      color: white;
      border: none;
    }
  </style>
</head>

<body>
  <h1>Edit Stock</h1>
  <!-- Displays stock current information. -->
  <p>Stock Name: <?php echo $stock['stock_name']; ?></p>
  <p>Stock Price: <?php echo $stock['stock_price']; ?></p>

  <!-- Form to edit stock. -->
  <form action="/Edit?id=<?php echo $_GET['id']; ?>" method="post">
    <input type="text" name="stock_name" placeholder="Stock Name">
    <input type="text" name="stock_price" placeholder="Stock Price">
    <button type="submit">Edit Stock</button>
  </form>
</body>

</html>
