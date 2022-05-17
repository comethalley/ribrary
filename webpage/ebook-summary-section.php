<?php
session_start();

if (!isset($_SESSION['id'])) {
  header("Location:user-login.php");
} else {
  include '../includes/autoload-class.php';
  include 'view-functions.php';
  $user = new User();
}

if (isset($_GET['file']) && isset($_GET['ebook_file'])) {
  $ebook_file = $_GET['ebook_file'];
  $file = $_GET['file'];

  $ebook_data = $user->getEbookData($ebook_file);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/sections.css">
  <link rel="stylesheet" href="css/transitions.css">
  <link rel="stylesheet" href="css/box.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <!-- sweet alert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- BOOTSTRAP ICON -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <style>
    .navbar {
      z-index: 1;
    }
  </style>
</head>

<body>
<!-- HEADER -->
<?php include 'header.php' ?>

<nav class="navbar sticky-top navbar-expand-lg navbar-dark mx-0 w-100" style="background-color: #485665;">
  <a class="navbar-brand" href="ebook-section.php">
    <img src="img/ribrary-logo-white.png" width="50" height="50" class="d-inline-block" alt="logo.png">
    Ribrary
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav ml-3 mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="ebook-section.php">Ebook<span class="sr-only">(current)</span></a>
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
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search">
      <button class="btn btn btn-outline-light my-2 my-sm-0 mr-5" type="submit">Search</button>
    </form>
</nav>
<div class="dropdown my-3 mx-3 float-right">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
    Categories
  </button>
  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
    <a class="dropdown-item text-dark" href="#">Health</a>
    <a class="dropdown-item text-dark" href="#">Physical</a>
    <a class="dropdown-item text-dark" href="#">Political</a>
    <a class="dropdown-item text-dark" href="#">Science</a>
    <a class="dropdown-item text-dark" href="#">Technology</a>
    <a class="dropdown-item text-dark" href="#">Case Study</a>
  </div>
</div>



  <main>
    <!--<div class="backdrop">
    <button class="upbtn" onclick="window.location.href='upload-audiobook-section.php'">Upload your own audiobook here!</button>
    <center>-->
    <!--  <button type="button" class="btn">Add Forum</button></p> -->
    </center>
    <main>
      <div class="container1 mx-auto my-5 p-2">
        <div class="row my-3">
          <div class="col-md-3 mx-auto">
            <img src="../functions/uploads/<?php echo $file; ?>" class="img-thumbnail mx-auto d-block" alt="cover" style="width:400px; height:300px;">
          </div>
        </div>
        <div class="row">
          <div class="col-md-9 mx-auto">
            <div class="card" style="width: 100%">
              <div class="card-body">
                <h5 class="card-title"><?php echo $ebook_data['ebooks_name'] ?></h5>
                <p class="card-text">Synopsis: <?php echo $ebook_data['synopsis'] ?></p>
              </div>
              <form action="view.php" method="GET">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Ratings</li>
                  <li class="list-group-item">Author: <?php echo $ebook_data['author'] ?></li>
                  <li class="list-group-item">Genre: <?php echo $ebook_data['categories'] ?></li>
                </ul>

                <input type="hidden" name="file" value="<?php echo $ebook_file ?>">
         
                <div class="card-body">
                  <button class="btn btn-primary">Start Reading</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </main>
  </main>


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
    <!-- SCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>