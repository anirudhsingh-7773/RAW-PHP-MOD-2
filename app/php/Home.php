<?php 

class Home {
  public function view() {
    require_once '../app/Dashboard/home.view.php';
  }
}

if (!$_SESSION['user']) {
  header('Location: /login');
  exit();
} else {
  $home = new Home();
  $home->view();  
}

