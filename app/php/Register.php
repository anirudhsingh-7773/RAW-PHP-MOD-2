<?php 

class Register {

  private $db;
  private $conn;

  public function dbConnect() {
    require_once '../app/db/Database.php';
    $this->db = new Database();
    $this->conn = $this->db->getConnection();
  }

  public function register($username, $password) {
    $this->dbConnect();
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user_table (user_name, password) VALUES (?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->close();
  }

  public function view() {
    require_once '../app/Dashboard/register.view.php';
  }
}

if ($_SESSION['user']) {
  header('Location: /');
  exit();
}

$register = new Register();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);

  $register->register($username, $password);
  header('Location: /login');
  exit();
} else {
  $register->view();
}