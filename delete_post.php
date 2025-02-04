<?php 
$servername = "localhost"; 
$username = "knockon_user"; 
$password = "bjhbrian0916"; 
$dbname = "knockon_db"; 

$conn = new mysqli($servername, $username, $password, $dbname); 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id']; 

$delete_sql = "DELETE FROM posts WHERE id=$id"; 
if ($conn->query($delete_sql) === TRUE) {
    echo "Post deleted successfully";
    header("Location: list_posts.php");
} else {
    echo "Error: " . $conn->error;
}
?>
