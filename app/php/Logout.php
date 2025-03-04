<?php

class Logout {
  public static function destroySession() {
    // Unset all session values
    $_SESSION[] = array();
    session_destroy();
  }
}

Logout::destroySession();
header('Location: /login');
exit();