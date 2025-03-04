<?php 

/**
 * class Login
 * 
 * Handles the login process.
 */
class Login {

  /**
   * Database object
   * @var 
   */
  private $db;
  /**
   * Database connection
   * @var 
   */
  private $conn;

  /**
   * Connect to the database
   */
  protected function dbConnect() {
    require_once '../app/db/Database.php';
    $this->db = new Database();
    $this->conn = $this->db->getConnection();
  }

  /**
   * Login function
   * 
   * @param string $username
   * @param string $password
   * @return int
   */
  public function login($username, $password) {
    // Connect to the database
    $this->dbConnect();
    $sql = "SELECT * FROM user_table WHERE user_name = ? LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    // Check if user is found.
    if ($result->num_rows > 0) {
      // Output data of each row.
      $row = $result->fetch_assoc();
      // Verify the password, return 1 if the password is correct
      // Else, return 0
      if ($this->passwordVerify($password, $row['password'])) {
        $stmt->close();
        return 1;
      } else {
        $stmt->close();
        return 0;
      }
    } else {
      $stmt->close();
      return 0;
    }
  }

  /**
   * Display the login form
   */
  public function view() {
    require_once '../app/Dashboard/login.view.php';
  }

  /**
   * Verify the password
   * 
   * @param string $password
   * @param string $hash
   * @return bool
   */
  protected function passwordVerify($password, $hash) {
    if (password_verify($password, $hash)) {
      return true;
    } else {
      return false;
    }
  }
}

// Checks if session exists, if true then send to home.
if  ($_SESSION['user']) {
  header('Location: /');
  exit();
}

// Instantiates the Login class.
$login = new Login();

// Check if the form is submitted.
// Else, display the login form.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the username and password from the form.
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);
  
  // Call the login function.
  $result = $login->login($username, $password);

  // If the result is greater than 0, then set the session and redirect to home.
  // Else, display an error message.
  if ($result > 0) {
    $_SESSION['user'] = $username;
    header('Location: /');
    exit();
  } else {
    echo "<script>
        alert('Invalid email or password.');
        setTimeout(function() {
            window.location.href = '/login';
        }, 500);
        </script>";
  }
} else {
  $login->view();
}
