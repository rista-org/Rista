<?php
include 'config.php';
require_once('header.php');
require_once('db.php');

$contact = $_SESSION['contact'];

// Prepare and execute query to fetch user profile
$photo_query = "SELECT * FROM profile WHERE Contact = ?";
$stmt = $connect->prepare($photo_query);
$stmt->bind_param('s', $contact);
$stmt->execute();
$profile_result = $stmt->get_result();
$Photo = $profile_result->fetch_assoc();

// Prepare and execute query to fetch user details
$query = "SELECT * FROM users WHERE contact = ?";
$stmt = $connect->prepare($query);
$stmt->bind_param('s', $contact);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// Handle form submissions
if (isset($_POST['edit'])) {
    header("Location: edit.php");
    exit();
} elseif (isset($_POST['back'])) {
    header("Location: connection.php");
    exit();
}
?>

<body>
    <div class="details_table">
        <?php if ($Photo): ?>
            <img src="<?php echo htmlspecialchars($Photo['path_to']); ?>" alt="<?php echo htmlspecialchars($Photo['Contact']); ?>"><br>
        <?php else: ?>
            <p>No photo available.</p>
        <?php endif; ?>
        <div class="details">
            Username: <?php echo htmlspecialchars($data['Name']); ?><br>
            Contact: <?php echo htmlspecialchars($data['Contact']); ?><br> 
            Address: <?php echo htmlspecialchars($data['Address']); ?><br>
            Age: <?php echo htmlspecialchars($data['Age']); ?><br>
            Qualification: <?php echo htmlspecialchars($data['Qualification']); ?><br>

            <form method="post">
                <button name="back">Back</button>
                <button name="edit">Edit</button>
            </form>
        </div>
    </div>   
</body>
