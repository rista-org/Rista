<?php
require_once('header.php');
require_once('connection_page.php');
require_once('db.php');
include 'users.php';

// Fetch the contact from the session
$contact = $_SESSION['contact'];
$connected = new Users($connect);
$result = $connected->connected($contact);

    // Check if there are any rows
    if ($result->num_rows > 0) {
        // Fetch and display each row
        while ($row = $result->fetch_assoc()) {
                $connected = $row['RequestedTo'];
                // Create an instance of Users and fetch user details
                $user = new Users($connect);
                $data= $user->fetch_data($connected);
                $photo = $user->fetch_photo($connected);

                $photos = [];
                while ($photo_row = mysqli_fetch_assoc($photo)) {
                    $photos[$photo_row['Contact']] = $photo_row['path_to'];
                }
                // Display the connection information
                ?>
                <table>
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
                </table>
                <?php
            }
        }
    echo "<br><br><a href='connection.php'>ADD</a>";


    // Close the prepared statement
    $stmt->close();


// Close the database connection
$connect->close();
?>
