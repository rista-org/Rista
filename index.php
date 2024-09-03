<?php
include 'config.php' ;
require_once('db.php'); // Ensure this file contains your database connection logic
if (isset($_POST['submit'])) {
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE Contact='$contact' AND Password='$password'";
    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['contact'] = $row['Contact'];
            echo "Login Sucessful";
            header("location:home.php");
        }
    }else{
            echo"Invalid Contact or Password";
        }
}
?>

<html>
<head>
    <link rel="stylesheet" href="./css/index.css">
    <title>Rista</title>
</head>
<body>

  <div class="salutation">
      <h2>WelCome To</h2>
      <h1>RISTA.COM</h1>
  </div>
  <div class="form">
      <form  method="post">
          <input type="text" name="contact" placeholder="Enter Your Contact"><br>
          <input type="password" name="password" placeholder="Enter Your Password"><br>
          <button name="submit" type="submit">Login</button>
      </form>
      Don't have an account?<a href="register.php">Register</a>
  </div>

</body>
</html>


