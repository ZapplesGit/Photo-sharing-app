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
                <li><a href="index.php">Home</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="upload.html">Upload</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2 class="main-title">Image Sharing App<br></h2>
        <h3>Aidan Gould-Pretorius</h3>

        <section class="image-gallery">
            <div class="image-container">
                <img src="\placeholders\chocolate cake.jfif" alt="Image 1">
            </div>
        </section>
    </main>

    <footer>
        <p>Website by Aidan Gould-Pretorius</p>
        <p>Your unique user ID: <?php echo $user_id; ?></p>
    </footer>
</body>

</html>