<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = 'vcr';

try {
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


define('Admin',1);
define('Agent',2);
?>