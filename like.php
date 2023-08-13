<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_db";

// Create a connection to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["like"])) {
    $image_id = $_POST["image_id"];

    // Update the "likes" count for the image in the database
    $update_sql = "UPDATE images SET likes = likes + 1 WHERE id = '$image_id'";
    if ($conn->query($update_sql) === TRUE) {
        // Redirect back to the gallery page after liking
        header("Location: gallery.php");
        exit();
    } else {
        echo "Error: " . $update_sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>