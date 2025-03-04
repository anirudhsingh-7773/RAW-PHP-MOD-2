<?php
require_once '../app/db/Stocks.php';
$stocks = new Stocks();

// Stores the stocks in an array.
$table = $stocks->getStockByUser($_SESSION['user']);
// Deletes the stock, if the id is set.
if (isset($_GET['id'])) {
  $stocks->deleteStock($_GET['id']);
  header('Location: /stock-entry');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stock Portfolio</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    header {
      display: flex;
      justify-content: end;
      background-color: black;
      width: 100%;
    }

    a {
      display: inline-block;
      padding: 0.5rem 1rem;
      background-color: red;
      text-decoration: none;
      font-size: 1.5rem;
      color: white;
      height: auto;
      margin: 0.5rem;
    }

    input {
      padding: 0.5rem;
      margin: 0.5rem;
    }

    
  </style>
</head>

<body>
  <header>
    <a href="/">Home</a>
    <a href="/stock-entry">Add Stocks</a>
    <a href="/logout">Logout</a>
  </header>

  <!-- Form to add stock. -->
  <h2>Add Stock</h2>
  <form action="/stock-entry" method="post">
    <input type="text" name="stock_name" placeholder="Stock Name">
    <input type="text" name="stock_price" placeholder="Stock Price">
    <input type="submit" value="Add Stock"></input>
  </form>

  <h2>Your Stocks:</h2>
  <table border="1">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Price</th>
      <th>Created On</th>
      <th>Last Updated</th>
      <th>Actions</th>
    </tr>
    <!-- Loop to display stock table. -->
    <?php foreach ($table as $stock): ?>
      <tr>
        <td><?php echo htmlspecialchars($stock['id']); ?></td>
        <td><?php echo htmlspecialchars($stock['stock_name']); ?></td>
        <td><?php echo htmlspecialchars($stock['stock_price']); ?></td>
        <td><?php echo htmlspecialchars($stock['created_on']); ?></td>
        <td><?php echo htmlspecialchars($stock['last_updated']); ?></td>
        <td>
          <!-- Delete button -->
          <a href="?id=<?php echo htmlspecialchars($stock['id']); ?>">Delete</a>
        </td>
        <td>
          <!-- Edit button -->
          <a href="/edit?id=<?php echo htmlspecialchars($stock['id']); ?>">Edit</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>
