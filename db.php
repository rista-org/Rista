<?php
ob_start();
session_start();
$server="localhost";
$username="root";
$password="";
$database="Rista";
$connect = mysqli_connect($server, $username, $password, $database);
if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="icon" href="../Profile/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rista</title>
</head>
</html>
