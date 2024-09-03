<?php
require_once('header.php');
include 'config.php';
require_once('db.php');
$contact=$_SESSION['contact'];
$query="SELECT * FROM `users` WHERE `contact`='$contact'";
$result=mysqli_query($connect,$query);
$data=mysqli_fetch_assoc($result);
?>
<body>
    <section>
        <h1>WelCome <br> <?php echo $data['Name'];?></h1>
    </section>
</body>