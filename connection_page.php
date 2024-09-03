<?php
include 'config.php';
require_once('db.php');
require_once('header.php');
?>

<body>
    <div class="list">
      <ul>
           <li><button type="button" onclick="location.href='connection.php'">Add</button></li>
           <li><button type="button" onclick="location.href='requested.php'">Requested</button></li>
           <li><button type="button" onclick="location.href='connected.php'">Connected</button></li>
      </ul>
    </div>
</body>
