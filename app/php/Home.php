<?php 

/**
 * Class Home
 * 
 * Handles the home page.
 */
class Home {

  /**
   * Displays the home page.
   * 
   * @return void
   */
  public function view() {
    require_once '../app/Dashboard/home.view.php';
  }
}

// If session doesn't exist, send to login page.
// Else, display the home page.
if (!$_SESSION['user']) {
  header('Location: /login');
  exit();
} else {
  $home = new Home();
  $home->view();  
}

