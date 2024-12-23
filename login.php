<?php 
session_start(); 
$servername = "localhost"; 
$username = "root"; 
$password = "v!=eQ=SSWst6"; 
$dbname = "bulletin_board"; 

$conn = new mysqli($servername, $username, $password, $dbname); 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $email = $_POST["email"]; 
    $password = $_POST["password"]; 
    $sql = "SELECT * FROM users WHERE email = '$email'"; 
    $result = $conn->query($sql); 
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); 
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"]; 
            $_SESSION["username"] = $user["username"]; 
            echo "Login successful";
            header("Location: list_posts.php");
	    exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found";
    }
}
?> 
<form method="POST"> 
    Email: <input type="email" name="email"><br> 
    Password: <input type="password" name="password"><br> 
    <button type="submit">Login</button>
</form>
