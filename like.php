<?php

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Implement rate limit
$rateLimit = 1; 
$timePeriod = 10; 
$userId = $user_id;

$currentTime = time();

$lastLikedTime = $_SESSION['last_liked_time'] ?? 0;

if ($currentTime - $lastLikedTime < $timePeriod) {
    //echo "Rate limit exceeded. Please wait before liking another image.";
    header("Location: gallery.php");
    exit();
} else {

    $image_id = $_POST["image_id"];
    $update_sql = "UPDATE images SET likes = likes + 1 WHERE id = '$image_id'";
    if ($conn->query($update_sql) === TRUE) {

        $_SESSION['last_liked_time'] = $currentTime;

        header("Location: gallery.php");
        exit();
    } else {
        echo "Error: " . $update_sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>