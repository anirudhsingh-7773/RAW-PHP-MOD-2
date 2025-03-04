<?php
require_once '../app/db/Stocks.php';
$stocks = new Stocks();

// Get all stocks.
$table = $stocks->getAllStocks();

// Check if the id is set, and delete the stock.
if (isset($_GET['id'])) {
  $stocks->deleteStock($_GET['id']);
  header('Location: /home');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
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
  </style>
</head>

<body>
  <header>
    <a href="/">Home</a>
    <a href="/stock-entry">Add Stocks</a>
    <a href="/logout">Logout</a>
  </header>
  <h1>Stocks</h1>
  <table border="1">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Price</th>
      <th>Created On</th>
      <th>Last Updated</th>
      <th>Actions</th>
    </tr>
    <?php foreach ($table as $stock): ?>
      <tr>
        <td><?php echo htmlspecialchars($stock['id']); ?></td>
        <td><?php echo htmlspecialchars($stock['stock_name']); ?></td>
        <td><?php echo htmlspecialchars($stock['stock_price']); ?></td>
        <td><?php echo htmlspecialchars($stock['created_on']); ?></td>
        <td><?php echo htmlspecialchars($stock['last_updated']); ?></td>
        <td>
          <!-- Show Delete button if logged in user has added the stock. -->
          <?php if ($stock['created_by'] == $_SESSION['user']) { ?>
            <a href="?id=<?php echo htmlspecialchars($stock['id']); ?>">Delete</a>
          <?php } ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>
