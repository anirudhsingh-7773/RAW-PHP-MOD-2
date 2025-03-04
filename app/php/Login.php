<?php 

class Login {

  private $db;
  private $conn;

  protected function dbConnect() {
    require_once '../app/db/Database.php';
    $this->db = new Database();
    $this->conn = $this->db->getConnection();
  }

  public function login($username, $password) {
    $this->dbConnect();
    $sql = "SELECT * FROM user_table WHERE user_name = ? LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      if ($this->passwordVerify($password, $row['password'])) {
        $stmt->close();
        return 1;
      } else {
        $stmt->close();
        return 0;
      }
    }
  }

  public function view() {
    require_once '../app/Dashboard/login.view.php';
  }

  protected function passwordVerify($password, $hash) {
    if (password_verify($password, $hash)) {
      return true;
    } else {
      return false;
    }
  }
}

if  ($_SESSION['user']) {
  header('Location: /');
  exit();
}

$login = new Login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);
  
  $result = $login->login($username, $password);

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
