<?php
session_start();
include '../includes/autoload-class.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/webdesign.css">
  <link rel="stylesheet" href="css/transitions.css">
  <!-- <link rel="stylesheet" href="css/box.css"> -->
  <link rel="stylesheet" href="css/book-section.css">
  <title>My Profile</title>

  <title>Books</title>
</head>

<body>
  <header>


    <div class="container">
      <div class="list">
        <button class="links">Settings</button>
        <button class="links">Help & Support</button>
        <button class="links">Log out</button>
      </div>
      <button class="click">...</button>
      <?php
      if (isset($_SESSION['first-name']) && isset($_SESSION['last-name']) && isset($_SESSION['email'])) {

      ?>
        <a href="UserProf.html" id="account-name">
          <p ><?php echo $_SESSION['first-name'] ?> <?php echo $_SESSION['last-name'] ?></p>
        </a>

        <img src="<?php echo $_SESSION["profile"] ?>" alt="" class="user-image">
      <?php
      }
      ?>
    </div>

    <script>
      let click = document.querySelector('.click');
      let list = document.querySelector('.list');
      click.addEventListener("click", () => {
        list.classList.toggle('newlist');
      });
    </script>
    <div class="header">
      <div class="navbar">
        <img src="img/books.png" class="books">
        <ul>
          <li><a href="books-section.html">Books</a></li>
          <li><a href="magazine-section.html">Magazine</a></li>
          <li><a href="audiobook-section.html">Audiobook</a></li>
          <li><a href="podcast-section.html">Podcast</a></li>
          <li><a href="document-section.html">Document</a></li>
          <li><a href="UserProf.html">Profile</a></li>
          <li><a href="">Search</a></li>
          <li><a href="upload-section.html">Upload</a></li>
        </ul>
      </div>
      <div class="content-header">
        <h1>
          <center>BOOKS</center>
        </h1>
      </div>
  </header>
  <main>
    <div class="backdrop"><button class="upbtn" onclick="window.location.href='upload-books-section.html'">Upload your
        own book here!</button>
      <center>
        <!-- <button type="button" class="btn">Add Book</button></p> -->
      </center>
      <div class="search-container">
        <p id="search-title">Search Books</p>

        <div id="search-input">
          <input type="text" placeholder="Search for title or author" id="searchBooks">
          <button id="search-button"><img src="img/search-icon.png"></button>
        </div>
      </div>

      <div class="display-books-container">

      </div>
      <script src="js/books-section.js"></script>

  </main>
</body>

</html>