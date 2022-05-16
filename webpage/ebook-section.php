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
  <link rel="stylesheet" href="css/box.css">
  <link rel="stylesheet" href="css/footer.css">
  <title>Ebook</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <style>
    .hide {
      display: none;
    }

    .categories-hidden {
      text-transform: capitalize;
    }
  </style>
</head>

<body>
  <header>
    <div class="container">
      <?php
      if (isset($_SESSION['first-name']) && isset($_SESSION['last-name']) && isset($_SESSION['email'])) {

      ?>
        <a href="UserProf.html" id="account-name">
          <p>Hi, <?php echo $_SESSION['first-name'] ?> <?php echo $_SESSION['last-name'] ?></p>
        </a>

        <img src="<?php echo $_SESSION["profile"] ?>" alt="" class="user-image">
      <?php
      }
      ?>
    </div>
  </header>
  <nav class="navbar sticky-top navbar-expand-lg navbar-dark mx-0 w-100" style="background-color: #485665;">
    <a class="navbar-brand" href="books-section.php">
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
        <li class="nav-item ">
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


  <div class="dropdown my-3 mx-0 float-right">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
      Categories
    </button>

    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
      <form action="" method="get" class="categories-form">
        <input type="hidden" name="categories-value" id="categories-value">

        <option class="dropdown-item text-dark" value="science fiction">Science Fiction</option>
        <option class="dropdown-item text-dark" value="fantasy">Fantasy</option>
        <option class="dropdown-item text-dark" value="mystery">Mystery</option>
        <option class="dropdown-item text-dark" value="horror">Horror</option>
        <option class="dropdown-item text-dark" value="adventure">Adventure</option>
        <option class="dropdown-item text-dark" value="romance">Romance</option>
        <a class="dropdown-item text-dark" href="books-section.php">Google Books</a>
      </form>
    </div>
  </div>



  <main>
    <!--<div class="backdrop">
    <button class="upbtn" onclick="window.location.href='upload-audiobook-section.php'">Upload your own audiobook here!</button>
    <center>-->
    <!--  <button type="button" class="btn">Add Forum</button></p> -->
    </center>
    <main>

      <div class="container1 mx-2 my-5">

        <div class="newly-release categories">
          <div class="row">
            <div class="col-md-12">
              <h6 class=" display-4 mx-3">Newly Release</h6>
              <hr>
            </div>
          </div>

          <div class="row mb-3 ml-2">
            <?php
            $data = $user->displayEbooks();
            foreach ($data as $row) {
            ?>
              <div class="col-md-3 my-2 my-md-3 rounded">
                <div class="card shadow text-center">
                  <div>
                    <img src="../functions/uploads/<?php echo $row['ebooks_cover_path'] ?>" class="card-img-top" alt="book-cover">
                  </div>
                  <div class="card-body">
                    <form action="ebook-summary-section.php" method="GET">
                      <p class="card-title"><?php echo $row["ebooks_name"] ?></p>
                      <p class="card-title">Rating: <?php showRating($row["ebooks_path"]) ?>/5</p>
                      <p class="card-text"><?php echo $row["author"] ?></p>
                      <p class="card-text"><?php echo $row["categories"] ?></p>
                      <input type="hidden" name="file" value="<?php echo $row['ebooks_cover_path'] ?>">
                      <input type="hidden" name="ebook_file" value="<?php echo $row['ebooks_path'] ?>">
                      <button class="btn btn-primary">Read</button>
                    </form>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
        <!-- --------------------------------------------------------------- -->

        <div class="most-popular categories">
          <div class="row">
            <div class="col-md-12">
              <h6 class=" display-4 mx-3">Most Popular</h6>
              <hr>
            </div>
          </div>

          <div class="row mb-3 ml-2">
          <?php
            $data = $user->displayEbooks();
            foreach ($data as $row) {
            ?>
              <div class="col-md-3 my-2 my-md-3 rounded">
                <div class="card shadow text-center">
                  <div>
                    <img src="../functions/uploads/<?php echo $row['ebooks_cover_path'] ?>" class="card-img-top" alt="book-cover">
                  </div>
                  <div class="card-body">
                    <form action="ebook-summary-section.php" method="GET">
                      <p class="card-title"><?php echo $row["ebooks_name"] ?></p>
                      <p class="card-title">Rating: <?php showRating($row["ebooks_path"]) ?>/5</p>
                      <p class="card-text"><?php echo $row["author"] ?></p>
                      <p class="card-text"><?php echo $row["categories"] ?></p>
                      <input type="hidden" name="file" value="<?php echo $row['ebooks_cover_path'] ?>">
                      <input type="hidden" name="ebook_file" value="<?php echo $row['ebooks_path'] ?>">
                      <button class="btn btn-primary">Read</button>
                    </form>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
        <!-- ----------------------------------------------------- -->

        <div class="science-fiction categories">
          <div class="row">
            <div class="col-md-12">
              <h6 class=" display-4 mx-3">Science Fiction </h6>

              <hr>
            </div>
          </div>
          <div class="row mb-3 ml-2">
          <?php
            $data = $user->displayEbooks('science fiction');
            foreach ($data as $row) {
            ?>
              <div class="col-md-3 my-2 my-md-3 rounded">
                <div class="card shadow text-center">
                  <div>
                    <img src="../functions/uploads/<?php echo $row['ebooks_cover_path'] ?>" class="card-img-top" alt="book-cover">
                  </div>
                  <div class="card-body">
                    <form action="ebook-summary-section.php" method="GET">
                      <p class="card-title"><?php echo $row["ebooks_name"] ?></p>
                      <p class="card-title">Rating: <?php showRating($row["ebooks_path"]) ?>/5</p>
                      <p class="card-text"><?php echo $row["author"] ?></p>
                      <p class="card-text"><?php echo $row["categories"] ?></p>
                      <input type="hidden" name="file" value="<?php echo $row['ebooks_cover_path'] ?>">
                      <input type="hidden" name="ebook_file" value="<?php echo $row['ebooks_path'] ?>">
                      <button class="btn btn-primary">Read</button>
                    </form>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
        <!-- ---------------------------------------------------->

        <div class="fantasy categories">
          <div class="row">
            <div class="col-md-12">
              <h6 class=" display-4 mx-3">Fantasy<h6>
                  <hr>
            </div>
          </div>
          <div class="row mb-3 ml-2">
          <?php
            $data = $user->displayEbooks('fantasy');
            foreach ($data as $row) {
            ?>
              <div class="col-md-3 my-2 my-md-3 rounded">
                <div class="card shadow text-center">
                  <div>
                    <img src="../functions/uploads/<?php echo $row['ebooks_cover_path'] ?>" class="card-img-top" alt="book-cover">
                  </div>
                  <div class="card-body">
                    <form action="ebook-summary-section.php" method="GET">
                      <p class="card-title"><?php echo $row["ebooks_name"] ?></p>
                      <p class="card-title">Rating: <?php showRating($row["ebooks_path"]) ?>/5</p>
                      <p class="card-text"><?php echo $row["author"] ?></p>
                      <p class="card-text"><?php echo $row["categories"] ?></p>
                      <input type="hidden" name="file" value="<?php echo $row['ebooks_cover_path'] ?>">
                      <input type="hidden" name="ebook_file" value="<?php echo $row['ebooks_path'] ?>">
                      <button class="btn btn-primary">Read</button>
                    </form>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
        <!-- ------------------------------------------------------ -->
        <div class="mystery categories">
          <div class="row">
            <div class="col-md-12">
              <h6 class=" display-4 mx-3 categories-hidden">Mystery</h6>
              <hr>
            </div>
          </div>
          <div class="row mb-3 ml-2">
          <?php
            $data = $user->displayEbooks('mystery');
            foreach ($data as $row) {
            ?>
              <div class="col-md-3 my-2 my-md-3 rounded">
                <div class="card shadow text-center">
                  <div>
                    <img src="../functions/uploads/<?php echo $row['ebooks_cover_path'] ?>" class="card-img-top" alt="book-cover">
                  </div>
                  <div class="card-body">
                    <form action="ebook-summary-section.php" method="GET">
                      <p class="card-title"><?php echo $row["ebooks_name"] ?></p>
                      <p class="card-title">Rating: <?php showRating($row["ebooks_path"]) ?>/5</p>
                      <p class="card-text"><?php echo $row["author"] ?></p>
                      <p class="card-text"><?php echo $row["categories"] ?></p>
                      <input type="hidden" name="file" value="<?php echo $row['ebooks_cover_path'] ?>">
                      <input type="hidden" name="ebook_file" value="<?php echo $row['ebooks_path'] ?>">
                      <button class="btn btn-primary">Read</button>
                    </form>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>

        <!-- -------------------------------------------------- -->
        <div class="hidden hide">
          <div class="row">
            <div class="col-md-12">
              <h6 class=" display-4 mx-3 categories-hidden"><?php echo $value ?></h6>
              <hr>
            </div>
          </div>
          <div class="row mb-3 ml-2">
          <?php
            $data = $user->displayEbooks($value);
            foreach ($data as $row) {
            ?>
              <div class="col-md-3 my-2 my-md-3 rounded">
                <div class="card shadow text-center">
                  <div>
                    <img src="../functions/uploads/<?php echo $row['ebooks_cover_path'] ?>" class="card-img-top" alt="book-cover">
                  </div>
                  <div class="card-body">
                    <form action="ebook-summary-section.php" method="GET">
                      <p class="card-title"><?php echo $row["ebooks_name"] ?></p>
                      <p class="card-title">Rating: <?php showRating($row["ebooks_path"]) ?>/5</p>
                      <p class="card-text"><?php echo $row["author"] ?></p>
                      <p class="card-text"><?php echo $row["categories"] ?></p>
                      <input type="hidden" name="file" value="<?php echo $row['ebooks_cover_path'] ?>">
                      <input type="hidden" name="ebook_file" value="<?php echo $row['ebooks_path'] ?>">
                      <button class="btn btn-primary">Read</button>
                    </form>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
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
    <script>
      const categories = document.querySelectorAll('.categories');
      const categoriesForm = document.querySelector('.categories-form')
      const dropdownMenu = document.querySelector('.dropdown-menu');
      const categoriesValue = document.querySelector('#categories-value');

      const url = window.location.search
      const urlParam = new URLSearchParams(url)
      const parameter = urlParam.get('categories-value')

      const hideCategories = function() {
        categories.forEach(section => {
          section.classList.add('hide')
        })
      }

      if (parameter) {
        hideCategories()
        document.querySelector('.hidden').classList.remove('hide')
      }

      dropdownMenu.addEventListener('click', function(e) {
        if (e.target.classList.contains('dropdown-item')) {
          const value = e.target.value
          categoriesValue.value = value
          categoriesForm.submit()

        }
      })
    </script>
</body>

</html>