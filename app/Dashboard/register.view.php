<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/register.css">
  <title>Register</title>
</head>

<body>
  <div class="register-container">
    <h2>Register</h2>
    <form action="/register" method="post">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" id="password" placeholder="Password" required>
      <span id="passwordMessage"></span>
      <input type="submit" value="Login" id="submit">
    </form>
    <a href="/login">Already a User? Login</a>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="/assets/js/scripts.js"></script>
</body>

</html>