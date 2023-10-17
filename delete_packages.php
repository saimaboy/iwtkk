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

    
    $packageID = mysqli_real_escape_string($conn, $_POST['pkg_id']);

    
    $sql = "DELETE FROM packages WHERE pkg_id = '$packageID'";
    if (mysqli_query($conn, $sql)) {
        echo '<h2>Package with ID ' . $packageID . ' deleted successfully. </h2>';
    } else {
        echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
    }

    
    mysqli_close($conn);
}
?>
