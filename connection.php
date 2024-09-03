<?php
require_once('header.php');
require_once('db.php');
require_once('connection_page.php');
include 'config.php';
include 'users.php';


// Check if the user is logged in
$contact = $_SESSION['contact'];
// Check if the form is submitted
if (isset($_POST['submit']) || isset($_POST['view'])) {
    $recipient_contact = mysqli_real_escape_string($connect, $_POST['recipient_contact']);
    
    if (isset($_POST['submit'])) {
        // Fetch recipient and sender details
        $sender = new Users($connect);
        $senderdata = $sender->fetch_data($contact);
        $reciverdata = $sender->fetch_data($recipient_contact);

        $notification_text = $senderdata['Name']." sent you a connection request.";
        $requested_text = "You sent the connection request to ".$reciverdata['Name'];
        
        $notification = "INSERT INTO notification (NotificationText, Contact, Sender) VALUES (?, ?, ?)";
        $requested = "INSERT INTO connected (Requested, Contact, RequestedTo) VALUES (?, ?, ?)";
        
        $stmt2 = mysqli_prepare($connect, $notification);
        mysqli_stmt_bind_param($stmt2, "sss", $notification_text, $recipient_contact, $contact);
        
        $stmt3 = mysqli_prepare($connect, $requested);
        mysqli_stmt_bind_param($stmt3, "sss", $requested_text, $contact, $recipient_contact);
        
        if (mysqli_stmt_execute($stmt2) && mysqli_stmt_execute($stmt3)) {
            echo "<p>Connection request sent successfully.</p>";
        } else {
            echo "Error: " . mysqli_error($connect);
        }
    }

    if (isset($_POST['view'])) {
        $_SESSION['view_contact'] = mysqli_real_escape_string($connect, $_POST['recipient_contact']);
        header('Location: profile.php');
        exit(); // Stop further execution
    }
}

$users = new Users($connect);
$user = $users->Users_data($contact);
$photo = $users->users_photo($contact);

$photos = [];
while ($photo_row = mysqli_fetch_assoc($photo)) {
    $photos[$photo_row['Contact']] = $photo_row['path_to'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
</head>
<body>
<table>
    <?php while ($data = mysqli_fetch_assoc($user))  {
        $result = $users->requested($contact, $data['Contact']);
        if($result->num_rows === 0){
        
        ?>
        <tr>
            <td>
                <?php if (isset($photos[$data['Contact']])) { ?>
                    <img src="<?php echo htmlspecialchars($photos[$data['Contact']]); ?>" alt="Profile Photo">
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td>Username:</td>
            <td><?php echo htmlspecialchars($data['Name']); ?></td>
        </tr>
        <tr>
            <td>Contact:</td>
            <td><?php echo htmlspecialchars($data['Contact']); ?></td>
        </tr>
        <tr>
            <td>Address:</td>
            <td><?php echo htmlspecialchars($data['Address']); ?></td>
        </tr>
        <tr>
            <form method="post">
                <input type="hidden" name="recipient_contact" value="<?php echo htmlspecialchars($data['Contact']); ?>">
                <td><button name="submit">Send request</button></td>
                <td><button name="view">View</button></td>
            </form>
        </tr>
    <?php } 
    }?>
</table>
</body>
</html>
