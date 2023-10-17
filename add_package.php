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
    
    $packageTitle = mysqli_real_escape_string($conn, $_POST['package-title']);
    $packageDescription = mysqli_real_escape_string($conn, $_POST['package-description']);
    $packagePrice = mysqli_real_escape_string($conn, $_POST['package-price']);
    $addToHomepage = isset($_POST['add-to-homepage']) ? 1 : 0;
 
    $targetDirectory = './img/';
    $targetFile = $targetDirectory . basename($_FILES['package-image']['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    
    $uploadOk = 1;
    if (isset($_POST['package-image'])) {
        $check = getimagesize($_FILES['package-image']['tmp_name']);
        if ($check === false) {
            echo 'File is not an image.';
            $uploadOk = 0;
        }
    }

    if (file_exists($targetFile)) {
        echo 'File already exists.';
        $uploadOk = 0;
    }


    if ($imageFileType !== 'jpg' && $imageFileType !== 'png' && $imageFileType !== 'jpeg' && $imageFileType !== 'gif') {
        echo 'Only JPG, JPEG, PNG, and GIF files are allowed.';
        $uploadOk = 0;
    }

   
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES['package-image']['tmp_name'], $targetFile)) {
            echo 'The file ' . htmlspecialchars(basename($_FILES['package-image']['name'])) . ' has been uploaded.';
        } else {
            echo 'Sorry, there was an error uploading your file.';
        }
    }

    $sql = "INSERT INTO packages (pt, pd, price, imageURL) VALUES ('$packageTitle', '$packageDescription', '$packagePrice', '$targetFile')";

    if (mysqli_query($conn, $sql)) {
        echo '<h2>Package added successfully.</h2>';
    } else {
        echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>
