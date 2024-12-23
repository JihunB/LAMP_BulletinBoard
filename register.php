<?php 

$servername = "localhost"; 
$username = "root"; 
$password = "v!=eQ=SSWst6"; 
$dbname = "bulletin_board"; 

$conn = new mysqli($servername, $username, $password, $dbname); 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $username = $_POST["username"]; 
    $email = $_POST["email"]; 
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); 
    
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')"; 
    if ($conn->query($sql) === TRUE) {
//        echo "Registration successful";
	header("Location: login.php");
	exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

?>
 
<form method="POST">
    Username: <input type="text" name="username"><br> 
    Email: <input type="email" name="email"><br> 
    Password: <input type="password" name="password"><br> 
    <button type="submit">Register</button>
</form>
