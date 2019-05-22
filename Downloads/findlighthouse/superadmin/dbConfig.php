<?php
// Database configuration
$dbHost = DB_HOST;
$dbUsername = DB_USER;
$dbPassword = DB_PASS;
$dbName = DB_NAME;

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>