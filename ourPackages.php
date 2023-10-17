<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Packages</title>
</head>
<body>
	<style>
	
	.header {
    display: flex;
    justify-content: space-between;
    background-color: #f2f2f2;
    padding: 20px;
}

.header h1 {
    color: orange;
    display: inline;
}

.header .name {
    color: blue;
    display: inline;
}

.header .nav {
    display: flex;
    align-items: center;
}

.header .nav a {
    text-decoration: none;
    color: #333;
    margin: 0 10px;
}
.package-banner {
    width: 90%;
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #f2f2f2;
    text-align: center;
}

.package-banner h2 {
    color: #333;
}

.package-banner p {
    color: #777;
    
    margin-top: 10px;
}

.package-banner a {
    background-color: orange;
    color: #fff;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 5px;
    display: inline-block;
    margin-top: 10px;
}
.footer {
    background-color: #f2f2f2;
    text-align: center;
    padding: 20px;
}

.footer img {
    width: 50px;
    height: auto;
    margin-right: 10px;
}
.img_pkg{
    width: auto ; 
    height: auto ;
}

	</style>
    

    <div class="header">
        <h1>Tour de <span class="name">Taprobane</span></h1>
        <div class="nav">
            <a href="#">Home</a>
            <a href="#">Destinations</a>
            <a href="#">Packages</a>
            <a href="#">Contact Us</a>
            <a href="#">About Us</a>
            <a href="login.html">Login</a>
            <a href="signup.html">Signup</a>
        </div>
    </div>

    
    <?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'taprobane';

    $conn = mysqli_connect($hostname, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM packages";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="package-banner">';
        echo '<p>ID -' . $row['pkg_id'] .'</p>';
        echo '<img src="' . $row['imageURL'] . '" alt="Tour Package Image class="img_pkg"">';
        echo '<h2>' . $row['pt'] . '</h2>';
        echo '<p>Rs.' . $row['price'] . '</p>';
        echo '<a href="book_now.html">Book Now</a>';
    
        echo '</div>';
    }

    mysqli_close($conn);
    ?>
    

    <div class="footer">
        <img src="img/logo4.png" alt="Company Logo">
        <p>Contact us: +123456789 | +987654321</p>
        <a href="#">Facebook</a>
        <a href="#">Twitter</a>
        <a href="#">Instagram</a>
    </div>
</body>
</html>
