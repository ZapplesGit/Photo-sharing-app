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

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["image"])) {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $file_name = $_FILES["image"]["name"];
    $file_tmp = $_FILES["image"]["tmp_name"];
    $file_size = $_FILES["image"]["size"]; 

    $max_file_size = 5 * 1024 * 1024; // 5MB file size limit

    if ($file_size <= $max_file_size) {
        $upload_path = "images/" . $file_name;
        move_uploaded_file($file_tmp, $upload_path);

        $sql = "INSERT INTO images (filename, title, description, uploaded_at, uploader_id) VALUES ('$file_name', '$title', '$description', NOW(), '$user_id')";

        if ($conn->query($sql) === TRUE) {
            echo "Image uploaded successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: The uploaded image exceeds the maximum file size limit of 5MB.";
    }
}

$conn->close();
?>