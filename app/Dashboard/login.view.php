<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/login.css">
  <title>Login</title>
</head>

<body>
  <div class="login-container">
    <h2>Login</h2>
    <form action="/login" method="post">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" id="password" placeholder="Password" required>
      <span id="passwordMessage"></span>
      <input type="submit" value="Login" id="submit">
    </form>
    <a href="/register">Register</a>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="/assets/js/scripts.js"></script>
</body>

</html>