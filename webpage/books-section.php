<?php
session_start();
include '../includes/autoload-class.php';

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
  <link rel="stylesheet" href="css/footer.css">
  <title>Ebooks</title>

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
  <header>
    <div class="container">
      <div class="list">
        <button class="links">Settings</button>
        <button class="links">Help & Support</button>

        <?php
        if (isset($_SESSION['first-name']) && isset($_SESSION['last-name']) && isset($_SESSION['email'])) {

        ?>
          <button class="links"><a href="../functions/logout-function.php">Log out</a></button>
        <?php
        } else {
        ?>
          <button class="links"><a href="Login-and-SignUp-page.html">Log In</a></button>
        <?php } ?>
      </div>

      <button class="click">...</button>

      <?php
      if (isset($_SESSION['first-name']) && isset($_SESSION['last-name']) && isset($_SESSION['email'])) {

      ?>
        <!-- NOtif button -->
        <div id="notification"><i class="bi bi-bell-fill"></i> <span class="notif-count"><?php
                                                                                          $user = new User();
                                                                                          $notifCount = $user->getUnreadNotif($_SESSION["id"]);

                                                                                          if ($notifCount) {
                                                                                            echo count($notifCount);
                                                                                          }
                                                                                          ?></span>
          <div class="notif-container hidden">

            <?php

            $data = $user->getNotification($_SESSION["id"]);
            foreach ($data as $row) {
            ?>
              <div class="notif-message">
                <p class="notif-date"><i><?php echo $row['date_and_time']; ?></i></p>
                <?php
                if ($row['status'] == 'pending') {
                ?>
                  <p class="notif-details"> We are verifying your uploaded document <?php echo $row['doc_name'] ?> please wait for a moment.</p>
                <?php
                } else if ($row['status'] == 'accepted') {
                ?>
                  <p class="notif-details"> Your uploaded document <?php echo $row['doc_name'] ?> has been accepted.</p>
                <?php
                } else if ($row['status'] == 'declined') {
                ?>

                  <p class="notif-details"> Your uploaded document <?php echo $row['doc_name'] ?> has been declined. </br> <span class="view-message"> View message
                      <input type="hidden" id="decline-message" value="<?php echo $row['message'] ?>"></span></p>
                <?php
                }
                ?>
              </div>
            <?php
            }
            ?>
          </div>
        </div>

        <!-- Notif content -->
        <a href="UserProf.html" id="account-name">
          <p>Hi, <?php echo $_SESSION['first-name'] ?> <?php echo $_SESSION['last-name'] ?></p>
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
  </header>

  <nav class="navbar sticky-top navbar-expand-lg navbar-dark mx-0 w-100" style="background-color: #485665; z-index: 1;">
    <a class="navbar-brand" href="books-section.php">
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

  <script>
    const notification = document.querySelector('#notification');
    const notifContainer = document.querySelector('.notif-container')

    function updateNotifStatus() {
      fetch('../functions/updateNotifStatus.php')
        .then(response => {
          return response.json()
        })
        .then(data => console.log(data))
    }

    notification.addEventListener('click', function() {
      notifContainer.classList.toggle('hidden')
      document.querySelector('.notif-count').remove()
      updateNotifStatus();

    })
  </script>
  <script src="js/books-section.js"></script>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

  <script>
    const notifMessage = document.querySelector('.notif-container')

    const seeMessage = function(message) {
      Swal.fire(
        'Research Document Declined',
        `${message}`,
        'info'
      )
    }
    notifMessage.addEventListener('click', function(e) {
      if (e.target.classList.contains('view-message')) {
        const message = e.target.firstElementChild.value;
        seeMessage(message)
      }
    })
  </script>
</body>

</html>