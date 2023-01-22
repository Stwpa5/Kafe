<?php
$servername ="sql200.epizy.com";
$username ="epiz_33105689";
$password ="ShY6nqSfUfObM";
$dbname ="epiz_33105689_Coffe";
$conn = mysqli_connect($servername, $username, $password, $dbname );
$conn -> set_charset("utf8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
?>
  
