<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Loads the App.php for routing
require_once '../app/App.php';

// Instantiates the App class
$app = new App();
$app->loadURL();
