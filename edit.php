<?php
include 'config.php';
require_once('header.php');
require_once('db.php');

session_start(); // Ensure session is started to access session variables
$contact = $_SESSION['contact'];

// Fetch user data from the database
$query = "SELECT * FROM `users` WHERE `contact` = ?";
$stmt = $connect->prepare($query);
$stmt->bind_param('s', $contact);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if (isset($_POST['cancel'])) {
    header('Location: details.php');
    exit();
}

if (isset($_POST['save'])) {
    // Process file upload
    if (isset($_FILES['Photo']) && $_FILES['Photo']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['Photo']['name'];
        $file_size = $_FILES['Photo']['size'];
        $file_tmp = $_FILES['Photo']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $upload_path = "./Profile/" . basename($file_name);

        // Move the uploaded file from the temporary location to the desired location
        if (move_uploaded_file($file_tmp, $upload_path)) {
            $sql = "INSERT INTO profile (Name, Size, Contact, path_to) VALUES (?, ?, ?, ?)";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param('siss', $file_name, $file_size, $contact, $upload_path);
            $stmt->execute();
            if (!$stmt) {
                echo "Error inserting file data: " . $connect->error;
            }
        } else {
            echo "Failed to upload file.";
        }
    }

    // Process form data
    $username = !empty($_POST['name']) ? $_POST['name'] : $data['Name'];
    $address = !empty($_POST['address']) ? $_POST['address'] : $data['Address'];
    $age = !empty($_POST['age']) ? $_POST['age'] : $data['Age'];
    $qualification = !empty($_POST['qualification']) ? $_POST['qualification'] : $data['Qualification'];

    $sql = "UPDATE users SET Name = ?, Address = ?, Age = ?, Qualification = ? WHERE Contact = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param('ssiss', $username, $address, $age, $qualification, $contact);
    if ($stmt->execute()) {
        header('Location: details.php');
        exit();
    } else {
        echo "Error updating data: " . $connect->error;
    }
}
?>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td><input type="file" name="Photo"></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="name" placeholder="<?php echo htmlspecialchars($data['Name']); ?>"></td>
            </tr>
            <tr>
                <td>Contact:</td>
                <td><input type="text" name="contact" value="<?php echo htmlspecialchars($data['Contact']); ?>" disabled></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><input type="text" name="address" placeholder="<?php echo htmlspecialchars($data['Address']); ?>"></td>
            </tr>
            <tr>
                <td>Age:</td>
                <td><input type="number" name="age" placeholder="<?php echo htmlspecialchars($data['Age']); ?>"></td>
            </tr>
            <tr>
                <td>Qualification:</td>
                <td><input type="text" name="qualification" placeholder="<?php echo htmlspecialchars($data['Qualification']); ?>"></td>
            </tr>
            <tr>
                <td><button name="cancel">Cancel</button></td>
                <td><button name="save">Save</button></td>
            </tr>
        </table>
    </form>
</body>
