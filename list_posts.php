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
$searchQuery = "";
if (isset($_GET['search'])) { 
	$searchQuery = $_GET['search'];
	$searchQuery = $conn->real_escape_string($searchQuery);
}

if ($searchQuery != "") {
	$sql = "SELECT * FROM posts WHERE title LIKE '%$searchQuery%' OR content LIKE '%$searchQuery%'";
} else {
	$sql = "SELECT * FROM posts"; 
}


$result = $conn->query($sql); 

echo "<h1>Post List</h1>";
while ($row = $result->fetch_assoc()) {
	echo "<p>" . $row["title"] . "-" . $row["created_at"] . "</p>";
	echo "<a href='edit_post.php?id=" . $row["id"] . "'>Edit</a> | ";
	echo "<a href='delete_post.php?id=" . $row["id"] . "'>Delete</a><br>";
}
?>

<form action="list_posts.php" method="GET">
	<input type="text" name="search" placeholder="Search posts..." value="<?php echo $searchQuery; ?>">
	<button type="submit">Search</button>
</form>
<a href="logout.php"><button>Logout</button></a>

<?php

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		echo "<div>";
		echo "<h3>" . $row['title'] . "</h3>";
		echo "<p>" . $row['content'] . "</p>";
		echo "</div>";
	}
} else { 
	echo "No posts found.";
}

$conn->close();
?>

