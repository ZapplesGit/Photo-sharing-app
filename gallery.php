<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Generate a unique identifier
    $user_id = uniqid();
    // Store the identifier in a session for future visits
    $_SESSION['user_id'] = $user_id;
} else {
    $user_id = $_SESSION['user_id'];
}
// Connect to MySql, or display an error
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM images ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Expo</title>
    <link rel="icon" type="image/png" href="\placeholders\chocolate cake compressed.jfif"/>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Tech Expo</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="upload-image.html">Upload</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="image-gallery">
            <!-- Displays images in a grid!-->
            <?php
            while ($row = $result->fetch_assoc()) {
                // Fetches the properties of the image from the database
                $image_path = "images/" . $row["filename"];
                $image_id = $row["id"];
                $likes = $row["likes"];
                $uploader_id = $row["uploader_id"];
                $user_id = $_SESSION['user_id'];
                echo '<div class="image-container">';
                // Displays the delete button, if the user ID is the same as the uploader of the image
                if ($uploader_id === $user_id) {
                    echo '<a class="delete-button" href="delete_image.php?image_id=' . $image_id . '">Delete</a>';}
                echo '<img src="' . $image_path . '" alt="' . $row["title"] . '" width="300">';
                echo '<div class="image-description">';
                echo '<h3>' . $row["title"] . '</h3>';
                echo '<p>' . $row["description"] . '</p>';
                echo '<form action="like.php" method="post">';
                echo '<input type="hidden" name="image_id" value="' . $image_id . '">';
                echo '<button type="submit" name="like" value="1">♥ Like this image ♥</button>';
                echo '</form>';
                echo '<p>Likes: ' . $likes . '</p>';
                echo '</div>';
                echo '</div>';
            }
            $conn->close();
            ?>
        </section>
    </main>
    <footer>
        <p>Website by Aidan Gould-Pretorius</p>
        <p>Your unique user ID: <?php echo $user_id; ?></p>
    </footer>
</body>

</html>
