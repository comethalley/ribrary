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
  <title>My Profile</title>

  <title>Books</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
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
                <p class="notif-details"> Your uploaded research document status <?php echo $row['doc_name'] ?> is <b><?php echo $row['status']; ?></b></p>
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

  <div class="sticky-section">
    <div id="logo">Ribrary</div>
    <nav>
      <a href="podcast-section.php">Podcast</a>
      <a href="magazine-section.php">Magazine</a>
      <a href="document-section.php">Document</a>
      <a href="audiobook-section.php">Audiobook</a>
      <a href="books-section.php">Ebooks</a>
    </nav>
  </div>

  <main>
    <div class="backdrop">
      <button class="upbtn" onclick="window.location.href='upload-books-section.php'">Upload your
        own book here!</button>
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

</body>

</html>