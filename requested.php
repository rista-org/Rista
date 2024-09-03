<?php
require_once('header.php');
require_once('connection_page.php');
require_once('db.php');
include 'users.php';

// Ensure that the user is logged in and session is started
$contact = $_SESSION['contact'];
$pending = 'pending';

// Fetch requests
$sql = "SELECT * FROM connected WHERE Contact = ? AND status = ? ";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, 'ss', $contact,$pending);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <form action="" method="post">
            <p><?php echo htmlspecialchars($row['Requested']) . "<br>"; ?>
            <input type="hidden" name="RequestedContact" value="<?php echo htmlspecialchars($row['RequestedTo']); ?>">
            <button type="submit" name="decline">Cancel</button>
            </p>
        </form>
        <?php
    }
}else{
    echo "No requests send";
    echo "<br><br><a href='connection.php'>ADD</a>";
}

// Handle form submission
if (isset($_POST['decline'])) {
    $RequestedTo= $_POST['RequestedContact'];

    $delete = new Delete($connect);
    $delete->ConnectedDelete($RequestedTo, $contact);

    $delete->NotificationDelete($RequestedTo, $contact);
    header("Location: requested.php");
    
    }

?>