<?php
require_once('db.php');
include 'config.php';
if(!isset($_SESSION['contact'])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/details.css">
    <link rel="stylesheet" href="../css/connection_page.css">
    <link rel="stylesheet" href="../css/connection.css">
    <link rel="stylesheet" href="../css/edit.css">
    <link rel="stylesheet" href="../css/notification.css">



    <title>Rista</title>
</head>
<body>
    <nav>
        <img src="../Profile/Logo.png">
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="details.php">Details</a></li>
            <li><a href="connection.php">Connection</a> </li>
            <li><a href="notification.php">Notification</a></li>
            <li><a href="logout.php">Logout</a></li>

        </ul>
    </nav>