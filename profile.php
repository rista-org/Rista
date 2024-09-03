<?php
    require_once('db.php');
    require_once('header.php');
    include 'users.php';


    $contact= $_SESSION['view_contact'];
    $view = new Users($connect);
    $data = $view->fetch_data($contact);
    $photo = $view->fetch_photo($contact);

?>
<body>
    <table>
        <tr>
            <td><img src="<?php echo htmlspecialchars($photo['path_to']); ?>" alt="ppphoto"></td>
        </tr>
        <tr>
            <td>Username:</td>
            <td><?php echo $data['Name'];?></td>
        </tr>
        <tr>
            <td>Contact:</td>
            <td><?php echo $data['Contact'];?></td>
        </tr>
        <tr>
            <td>Address:</td>
            <td><?php echo $data['Address'];?></td>
        </tr>
        <tr>
            <td>Age:</td>
            <td><?php echo $data['Age'];?></td>
        </tr>
        <tr>
            <td>Qualification:</td>
            <td><?php echo $data['Qualification'];?></td>
        </tr>
    </table>
</body>
