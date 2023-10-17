<?php
// Retrieve the user input from the form
$pt = $_POST['Package_Title'] ?? '';
$pd = $_POST['Package_description'] ?? '';
$price = $_POST['Price'] ?? '';

// Image upload
$target_dir = "img/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a valid image
if (isset($_FILES["image"]["tmp_name"]) && is_uploaded_file($_FILES["image"]["tmp_name"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // Allow certain file formats
        $allowed_formats = ["jpg", "jpeg", "png", "gif"];
        if (in_array($imageFileType, $allowed_formats)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                include 'dbconnect.php';

                // Prepare and bind the statement
                $stmt = $conn->prepare("INSERT INTO mobile (Package_Title, Package_description, Price, ImageURL) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $pt, $pd, $price, $target_file);
                
                // Execute the statement
                if ($stmt->execute()) {
                    // Check if the data was inserted successfully
                    if ($stmt->affected_rows > 0) {
                        echo "Successful!";
                        header("Location: ../index.php");
                    } else {
                        echo "Error: Failed to insert data.";
                    }
                } else {
                    echo "Error: Failed to execute the statement." . $stmt->error;
                }

                // Close the statement and the database connection
                $stmt->close();
                $conn->close();
            } else {
                echo "Error: There was a problem uploading the image.";
            }
        } else {
            echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        echo "Error: The uploaded file is not an image.";
    }
} else {
    echo "Error: No image was uploaded.";
}
?>
