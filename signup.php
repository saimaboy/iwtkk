<?php
require_once "connection/dbconnect.php";

$successMessage = "";
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT); 

    $checkQuery = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($connection, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        $errorMessage = "Username or email already exists. Please choose another.";
    } else {
        // Perform input validation
        if (empty($username) || empty($email) || empty($password)) {
            $errorMessage = "Please fill in all fields";
        } elseif ($password !== $_POST["retype-password"]) {
            $errorMessage = "Passwords do not match";
        } else {
            $sql = "INSERT INTO users (id, username, email, password) VALUES ('', '$username', '$email', '$hashedPassword')";

            if (mysqli_query($connection, $sql)) {
                $successMessage = "Signup successful.";
            } else {
                $errorMessage = "Error: " . $sql . "<br>" . mysqli_error($connection);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .header {
            background-color: #f2f2f2;
            text-align: center;
            padding: 20px 0;
        }
        .header h1 {
            color: orange;
            display: inline;
        }
        .header .name {
            color: blue;
            display: inline;
        }
        .signup-container {
            display: flex;
            align-items: center;
        }
        .login-box {
            flex: 1;
            max-width: 60%;
            height: 90vh;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
			margin-left: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        .image {
            flex: 1;
            max-width: 30%;
            padding: 20px;
        }
        .signup-title {
            font-size: 24px;
            text-align: center;
        }
        .form-group {
            margin: 20px 0;
        }
        .form-group label, .form-group input {
            display: block;
        }
        .form-group input {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .signup-button {
            background-color: orange;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            display: block;
            margin: 20px auto;
        }
        .footer {
            background-color: #f2f2f2;
            text-align: center;
            padding: 10px 0;
        }
        .footer a {
            color: blue;
            text-decoration: none;
            margin: 0 10px;
        }
				.footer img {
    width: 50px;
    height: auto; 
    margin-right: 10px; 
}
    </style>
</head>
<body>
    <div class="header">
        <h1>Tour de <span class="name">Taprobane</span></h1>
    </div>
    <div class="signup-container">
        <div class="login-box">
            <h2 class="signup-title">Signup</h2>
            <form id="signup-form" onsubmit="return validateForm()" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password">
                </div>
                <div class="form-group">
                    <label for="retype-password">Retype Password:</label>
                    <input type="password" id="retype-password" name="retype-password" placeholder="Retype your password">
                </div>
                <button class="signup-button" type="submit">Signup</button>
            </form>
            <p><a href="login.php">Already have an account? Login</a></p>
        </div>
        <img src="img/Rectangle 5936.jpg" alt="Tour de Taprobane" class="image" />
    </div>
    <div class="footer">
	<img src="img/logo4.png" alt="Company Logo">
        <p>Contact us: +123456789 | +987654321</p>
        <a href="#">Facebook</a>
        <a href="#">Twitter</a>
        <a href="#">Instagram</a>
    </div>
	
	<script>
    function validateForm() {
        var username = document.getElementById("username").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var retypePassword = document.getElementById("retype-password").value;

        if (username === "" || email === "" || password === "" || retypePassword === "") {
            alert("Please fill in all fields");
            return false;
        }

        if (password !== retypePassword) {
            alert("Passwords do not match");
            return false;
        }

        return true;
    }

    document.getElementById("signup-form").onsubmit = validateForm;


    <?php if (!empty($successMessage)) { ?>
            alert("<?php echo $successMessage; ?>");
            window.location.href = './login.php';
    <?php } ?>

    <?php if (!empty($errorMessage)) { ?>
            alert("<?php echo $errorMessage; ?>");
    <?php } ?>

</script>

	
</body>
</html>
