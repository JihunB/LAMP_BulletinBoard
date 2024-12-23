<?php 
session_start();
if (!isset($_SESSION["user_id"])) {
    echo "You must be logged in to edit a post.";
    exit();
}

$servername = "localhost"; 
$username = "root"; 
$password = "v!=eQ=SSWst6"; 
$dbname = "bulletin_board"; 

$conn = new mysqli($servername, $username, $password, $dbname); 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id = $_GET['id']; 

$sql = "SELECT * FROM posts WHERE id=$id";
$result = $conn->query($sql); 
$post = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title']; 
    $content = $_POST['content'];
 
    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id"; 
    if ($conn->query($sql) === TRUE) {
        echo "Post updated successfully";
        header("Location: list_posts.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

?>
<form method="POST">
    Title: <input type="text" name="title" value="<?php echo $post["title"]; ?>"><br> 
    Content: <textarea name="content"><?php echo $post["content"]; ?></textarea><br></form> 
    <button type="submit">Update Post</button>
</form>
