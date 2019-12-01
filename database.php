<?php
// used to connect to the database
$host = "localhost"; // database host name
$db_name = "php_beginner_crud_level_1"; // database name
$username = "root"; // database username
$password = "root"; // database password (if your database doesn't have a password remove the root
  
  // PDO connect
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}
  
// show error
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}
?>