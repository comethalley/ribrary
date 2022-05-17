<?php
session_start();

if (!isset($_SESSION['id'])) {
  header("Location:user-login.php");
} else {
  include '../includes/autoload-class.php';
  include 'view-functions.php';
  $user = new User();
}

if (isset($_GET['categories-value'])) {
  $value = $_GET['categories-value'];
}

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
  <link rel="stylesheet" href="css/UserProf.css">
  <title>Ticket</title>

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
  <nav class="navbar sticky-top navbar-expand-lg navbar-dark mx-0 w-100" style="background-color: #485665;">
    <a class="navbar-brand" href="ebook-section.php">
      <img src="img/ribrary-logo-white.png" width="50" height="50" class="d-inline-block" alt="logo.png">
      Ribrary
    </a>
  </nav>

  <div class="container1 my-3 p-5">
    <div class="row">
      <div class="col-12 mb-2">
        <h5 class="display-4 text-center">Encountered a problem ? Need support? <br>Let us know by sending a report !</h5>
      </div>  
      <div class="col-12 border">
        <p class="display-4 text-center">Fill up the information</p>
        <hr>
        <form>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="subject">Subject</label>
              <input type="text" class="form-control" id="subject" placeholder="What your concern is all about?">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" placeholder="email@gmail.com">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="address">Body</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
            </div>
          </div>
        <button type="submit" class="btn btn-primary btn-sm mr-5 my-5">Send</button>
      </div>
    </div>
  </div>
   
  <center>
    <footer class="site-footer">
      <h6>Ribrary</h6>
      <ul class="footer-links">
        <li><a href="">About Us</a></li>
        <li><a href="">Contacts</a></li>
        <li><a href="">Help & Support</a></li>
        <h6>‎© Ribrary 2022. All Rights Reserve</h6>
      </ul>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
    </footer>
  </center>  
 <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</body>
</html>