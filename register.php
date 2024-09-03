<?php
// Include the database connection file
include 'db.php';

// Check if a file was uploaded
if(isset($_POST['submit'])){  
   if($_POST['Password'] === $_POST['CPassword']){
    $name = $_POST['Name'];
    $contact = $_POST['Contact'];
    $age = $_POST['Age'];
    $address = $_POST['Address'];
    $qualification = $_POST['Qualification'];
    $password = $_POST['Password'];
    $register = "INSERT INTO users (Name, Age, Address, Qualification, Contact, Password) VALUES (?, ?, ?, ?, ?, ?) ";
    $stmt = $connect->prepare($register);
    $stmt->bind_param("sissis", $name, $age, $address, $qualification, $contact, $password);
    $stmt->execute();

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileName = $_FILES['photo']['name'];
        $fileSize = $_FILES['photo']['size'];
        $fileType = $_FILES['photo']['type'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Validate file extension (allow only certain file types)
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileExtension, $allowedExtensions)) {
            // Create a unique file name to avoid conflicts
            $newFileName = uniqid() . '.' . $fileExtension;
            $uploadPath = './Profile/' . $fileName;

            // Move the file to the desired directory
            if (move_uploaded_file($fileTmpPath, $uploadPath)) {
                // Prepare and execute the SQL query
                $stmt2 = $connect->prepare("INSERT INTO profile (path_to, Name, Size, Contact) VALUES (?, ?, ?, ?)");
                if ($stmt2) {
                    $stmt2->bind_param("ssii", $uploadPath, $fileName, $fileSize, $contact);
                    if ($stmt2->execute()) {
                        $stmt2->close();
                        header('Location : index.php');
                        echo 'File uploaded and data saved successfully!';
                    } else {
                        echo 'Error executing query: ' . $stmt->error;
                    }
                    
                } else {
                    echo 'Error preparing statement: ' . $mysqli->error;
                }
            } else {
                echo 'Error moving the uploaded file.';
            }
        } else {
            echo 'Invalid file extension.';
        }
    } else {
        echo 'No file uploaded or upload error.';
    }
    header('Location : index.php');

   }else {
    echo "Password doesn't match";
   }
    
}
header('Location : index.php');

// Close the database connection
$connect->close();
?>

    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>
                <input type="file" name="photo" accept="image/*" required>
                </td>

            </tr>

            <tr>
                <td>Name:</td>
                <td><input type="text" name="Name" placeholder="Username" required></td>
            </tr>
            <tr>
                <td>Contact:</td>
                <td><input type="number" name="Contact" placeholder="Contact" required></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><input type="text" name="Address" placeholder="Address" required></td>
            </tr>
            <tr>
                <td>Age:</td>
                <td><input type="number" name="Age" placeholder="Age" required></td>
            </tr>
            <tr>
                <td>Qualification:</td>
                <td><input type="text" name="Qualification" placeholder="Qualification" required></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="Password" id=""></td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td><input type="password" name="CPassword" id=""></td>
            </tr>
            <tr>
                <td>
                    <button type="submit" name="submit">Register</button>
                </td>
            </tr>
        </table>
    </form>