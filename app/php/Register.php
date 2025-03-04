<?php 

/**
 * class Register
 * 
 * Handles the registration process.
 */
class Register {

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
  public function dbConnect() {
    require_once '../app/db/Database.php';
    $this->db = new Database();
    $this->conn = $this->db->getConnection();
  }

  /**
   * Register function
   * 
   * @param string $username
   * @param string $password
   */
  public function register($username, $password) {
    // Connect to the database.
    $this->dbConnect();
    // Hash the password.
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user_table (user_name, password) VALUES (?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->close();
  }

  /**
   * View function
   */
  public function view() {
    require_once '../app/Dashboard/register.view.php';
  }
}

// Check if the user is logged in, if yes, send to home.
if ($_SESSION['user']) {
  header('Location: /');
  exit();
}

// Instantiates the Register class.
$register = new Register();

// Check if the form is submitted.
// Else, display the registration form.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Santize the input.
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);

  // Register the user.
  $register->register($username, $password);
  // Redirect to the login page.
  header('Location: /login');
  exit();
} else {
  $register->view();
}