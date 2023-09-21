<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

// Checks and establishes a connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["image"])) {
    // Gets the file information
    $title = $_POST["title"];
    $description = $_POST["description"];
    $file_name = $_FILES["image"]["name"];
    $file_tmp = $_FILES["image"]["tmp_name"];
    $file_size = $_FILES["image"]["size"];
    $file_type = $_FILES["image"]["type"];

    $max_file_size = 5 * 1024 * 1024; // 5MB file size limit
    $allowed_image_types = array("image/jpeg", "image/jpg", "image/png", "image/gif"); // Supported file types

    // Checks if the file fits the requirements
    if ($file_size <= $max_file_size && in_array($file_type, $allowed_image_types)) {
        $upload_path = "images/" . $file_name;
        move_uploaded_file($file_tmp, $upload_path);

        // Prepares to insert data to the database safely and avoiding SQL injection
        $stmt = $conn->prepare("INSERT INTO images (filename, title, description, uploaded_at, uploader_id) VALUES (?, ?, ?, NOW(), ?)");

        // Binds parameters
        $stmt->bind_param("ssss", $file_name, $title, $description, $user_id);

        // Success message if the process is executed
        if ($stmt->execute()) {
            echo "<p style='text-align: center;'>Image uploaded successfully!</p>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();

    } else {
        // Prints an error statement for the user if there is a problem
        if (!in_array($file_type, $allowed_image_types)) {
            echo "<p style='text-align: center;'>Error: Only JPEG, JPG, PNG, and GIF image types are allowed.</p>";
        } else {
            echo "<p style='text-align: center;'>Error: The uploaded image exceeds the maximum file size limit of 5MB.</p>";
        }
    }
}

$conn->close();
?>
