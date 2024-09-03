<?php
include 'config.php';   
require_once('header.php');
require_once('db.php');
include 'users.php';


// Ensure that the session is started
$contact = $_SESSION['contact'];

// Prepare SQL statement to fetch notifications for the logged-in user
$sql = "SELECT * FROM notification WHERE Contact = ?";
if ($stmt = mysqli_prepare($connect, $sql)) {
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "i", $contact);
    
    // Execute the statement
    mysqli_stmt_execute($stmt);
    
    // Get result
    $result = mysqli_stmt_get_result($stmt);
    
    // Fetch all notifications
    $notifications = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $notifications[] = $row;
    }
    
    // Close the prepared statement
} else {
    echo "Error preparing statement: " . mysqli_error($connect);
}

// Close the database connection
?>
<html>
<head>
</head>
<body>
<div class="container">
    <?php
    // Display notifications
    if (!empty($notifications)) {
        foreach ($notifications as $notification) {
            ?>
            <form action="" method="post">
                <?php echo htmlspecialchars($notification['NotificationText']); ?>
                <input type="hidden" name="sender" value="<?php echo htmlspecialchars($notification['Sender']); ?>">
                <button type="submit" name="accept">Accept</button>
                <button type="submit" name="decline">Decline</button>
            </form>
    <?php
        }
    } else {
        echo "<p>No notifications.</p>";
    }
    ?>
</div>
</body>
</html>

<?php
// Reopen the database connection for handling POST requests
require_once('db.php');

// Accept or decline notification
if (isset($_POST['accept']) || isset($_POST['decline'])) {
    $sender = $_POST['sender'];

    // Prepare and execute SQL queries
    if (isset($_POST['accept'])) {
        $delete = new Delete($connect);
        $delete->ConnectedDelete($sender, $contact);
        $delete->NotificationDelete($sender, $contact);
        $status ='Connected';
        $Requested = 'You are connected with each other.';
        $acceptInsert = "INSERT INTO connected (Contact, status, RequestedTo, Requested) VALUES (?, ?, ?, ?)";
        $AcceptInsert = "INSERT INTO connected (Contact, status, RequestedTo, Requested) VALUES (?, ?, ?, ?)";

        $stmtAccept = mysqli_prepare($connect, $acceptInsert);
        $stmtaccept = mysqli_prepare($connect, $AcceptInsert);


        mysqli_stmt_bind_param($stmtAccept, 'isis', $contact, $status, $sender, $Requested);
        mysqli_stmt_bind_param($stmtaccept, 'isis', $sender,$status,  $contact, $Requested);

        mysqli_stmt_execute($stmtAccept);
        mysqli_stmt_execute($stmtaccept);


        mysqli_stmt_close($stmtAccept);
        mysqli_stmt_close($stmtaccept);

    }

    if (isset($_POST['decline'])) {
        $delete = new Delete($connect);
        $delete->ConnectedDelete($sender, $contact);
        $$delete->NotificationDelete($sender, $contact);
    }

    // Close the database connection
    mysqli_close($connect);

    // Redirect after handling the form
    header("Location: notification.php");
    exit();
}
?>
