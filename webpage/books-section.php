<?php
session_start();
include '../includes/autoload-class.php';
$user = new User();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/sections.css">
  <link rel="stylesheet" href="css/transitions.css">
  <!-- <link rel="stylesheet" href="css/box.css"> -->
  <link rel="stylesheet" href="css/book-section.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
  <title>Google Books</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

  <!-- sweet alert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    .view-message {
      color: red;
    }

    .view-message:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <!-- HEADER -->
  <?php include 'header.php' ?>

  <nav class="navbar sticky-top navbar-expand-lg navbar-dark mx-0 w-100" style="background-color: #485665; z-index: 1;">
    <a class="navbar-brand" href="ebook-section.php">
      <img src="img/ribrary-logo-white.png" width="50" height="50" class="d-inline-block" alt="logo.png">
      Ribrary
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav ml-3 mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="ebook-section.php">Ebook<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="audiobook-section.php">Audiobook</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="podcast-section.php">Podcast</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="document-section.php">Research Document</a>
        </li>

      </ul>
  </nav>
  <div class="dropdown my-3 mx-3 float-right">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
      Categories
    </button>
    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
      <a class="dropdown-item text-dark" href="#">Scince Fiction</a>
      <a class="dropdown-item text-dark" href="#">Fantasy</a>
      <a class="dropdown-item text-dark" href="#">Mystery</a>
      <a class="dropdown-item text-dark" href="#">Horror</a>
      <a class="dropdown-item text-dark" href="#">Adventure</a>
      <a class="dropdown-item text-dark" href="#">Romance</a>
    </div>
  </div>

  <main>
    <div class="backdrop">
      <!--<button class="upbtn" onclick="window.location.href='upload-books-section.php'">Upload your
        own book here!</button>-->
      <center>
        <!-- <button type="button" class="btn">Add Book</button></p> -->
      </center>
      <div class="search-container">
        <!--  <p id="search-title">Search Books</p> -->

        <div id="search-input">
          <input type="text" placeholder="Search for title or author" id="searchBooks" required>
          <button id="search-button"><img src="img/search-icon.png"></button>
        </div>
      </div>

      <div class="display-books-container">

      </div>
    </div>
  </main>

 
  <script src="js/books-section.js"></script>
  <script src="js/header.js"></script>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</body>

</html>