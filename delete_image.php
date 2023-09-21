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

// Gets the image to be deleted
$image_id = $_GET['image_id'];
$sql = "SELECT uploader_id FROM images WHERE id = '$image_id'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
  $row = $result->fetch_assoc();
  $uploader_id = $row['uploader_id'];
  $user_id = $_SESSION['user_id'];
  // Checks that the user has permission to delete, if the delete button somehow displays
  if ($uploader_id === $user_id) {
    $delete_sql = "DELETE FROM images WHERE id = '$image_id'";
    if ($conn->query($delete_sql) === TRUE) {
      $image_path = "images/" . $image_id . ".jpg";
      unlink($image_path);
      // Redirect back to the gallery after deletion
      header("Location: gallery.php");
      exit();
    } else {
      echo "Error: " . $delete_sql . "<br>" . $conn->error;
    }
  } else {
    echo "You do not have permission to delete this image.";
  }
} else {
  echo "Image not found.";
}

$conn->close();
?>
