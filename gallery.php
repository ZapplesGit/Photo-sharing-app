<?php
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "gallery_db"; // Replace with your database name

// Create a connection to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve image data from the database
$sql = "SELECT * FROM images ORDER BY uploaded_at DESC";
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Expo</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>Tech Expo</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="upload.html">Upload</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="image-gallery">
            <?php
            while ($row = $result->fetch_assoc()) {
                $image_path = "images/" . $row["filename"];
                $image_id = $row["id"]; // Add this line to get the image ID
                $likes = $row["likes"]; // Get the number of likes
                echo '<div class="image-container">';
                echo '<img src="' . $image_path . '" alt="' . $row["title"] . '" width="300">';
                echo '<div class="image-description">';
                echo '<h3>' . $row["title"] . '</h3>';
                echo '<p>' . $row["description"] . '</p>';
                echo '<form action="like.php" method="post">';
                echo '<input type="hidden" name="image_id" value="' . $image_id . '">';
                echo '<button type="submit" name="like" value="1">♥</button>';
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
    </footer>
</body>

</html>
