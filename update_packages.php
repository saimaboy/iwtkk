
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'taprobane';

   
    $conn = mysqli_connect($hostname, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    
    $packageID = mysqli_real_escape_string($conn, $_POST['package_id']);
    $packageTitle = mysqli_real_escape_string($conn, $_POST['update-title']);
    $packageDescription = mysqli_real_escape_string($conn, $_POST['update-description']);
    $packagePrice = mysqli_real_escape_string($conn, $_POST['update-price']);

    
    $targetDirectory = 'img/';
    $targetFile = $targetDirectory . basename($_FILES['update-image']['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    
    $uploadOk = 1;
    if (isset($_POST['update-image'])) {
        $check = getimagesize($_FILES['update-image']['tmp_name']);
        if ($check === false) {
            echo 'File is not an image.';
            $uploadOk = 0;
        }
    }

    
    if ($_FILES['update-image']['size'] > 500000) {
        echo 'File is too large.';
        $uploadOk = 0;
    }

    
    if ($imageFileType !== 'jpg' && $imageFileType !== 'png' && $imageFileType !== 'jpeg' && $imageFileType !== 'gif') {
        echo 'Only JPG, JPEG, PNG, and GIF files are allowed.';
        $uploadOk = 0;
    }

    
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES['update-image']['tmp_name'], $targetFile)) {
            echo 'The file ' . htmlspecialchars(basename($_FILES['update-image']['name'])) . ' has been uploaded.';
        } else {
            echo 'Sorry, there was an error uploading your file.';
        }
    }

    
    $sql = "UPDATE packages SET pt = '$packageTitle', pd = '$packageDescription', price = '$packagePrice', imageURL = '$targetFile' WHERE pkg_id = '$packageID'";
    if (mysqli_query($conn, $sql)) {
        echo '<h2>Package updated successfully.</h2>';
    } else {
        echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
