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
  <link rel="icon" type="image/png" href="\placeholders\chocolate cake compressed.jfif"/>
  <link rel="stylesheet" href="style.css">
</head>

<!-- Header !-->
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
    <h2 class="main-title">Image Sharing App<br></h2>
    <h3>Hover on the cake for info!</h3>

    <section class="image-gallery">
      <div class="home-image-container">
        <img src="\placeholders\chocolate cake compressed.jfif" alt="Image 1">
        <div class="image-info">
          <p>Welcome to the Tech Expo image sharing app! Get started by checking 
            out the Gallery page, and liking and image. Be careful, though - 
            you may only like an image once per 10 seconds! Alternatively, head 
            over to the Upload page and contribute to the site with your own
            image to share, complete with a title and description. Just make sure 
            your image is below 5MB and is a supported file type!
          </p>
        </div>
      </div>
      
    </section>
  </main>

  <footer style="position: fixed; bottom: 0; width: 100%;">
    <p>Website by Aidan Gould-Pretorius</p>
  </footer>
</body>

</html>