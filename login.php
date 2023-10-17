<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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
        .login-container {
            display: flex;
            align-items: center;
        }
        .image {
            flex: 1;
            max-width: 30%;
            padding: 20px;
        }
        .login-box {
            flex: 1;
			max-width: 60%;
			height: 90vh;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        .login-title {
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
        .login-button {
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
    <div class="login-container">
        <img src="img/elephant.jpg" alt="Tour de Taprobane" class="image" />
        <div class="login-box">
            <h2 class="login-title">Login</h2>
            <form id="login-form" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password">
                </div>
                <button class="login-button" type="submit">Login</button>
            </form>
            <p><a href="signup.php">Sign up</a> | <a href="#">Forgot password</a></p>
        </div>
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
        var password = document.getElementById("password").value;

        if (username === "" || password === "" ) {
            alert("Please fill in all fields");
            return false;
        }
    }

    document.getElementById("login-form").onsubmit = validateForm;
</script>
</body>
</html>
