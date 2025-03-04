<?php

/**
 * class Logout
 * 
 * Handles the logout process.
 */
class Logout {

  /**
   * Destroy the session
   */
  public static function destroySession() {
    // Unset all session values
    $_SESSION[] = array();
    session_destroy();
  }
}

// Destroy the session
Logout::destroySession();
// Redirect to the login page
header('Location: /login');
exit();
