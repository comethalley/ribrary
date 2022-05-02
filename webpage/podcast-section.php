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
    <link rel="stylesheet" href="css/box.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>Podcast</title>
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
            <p >Hi, <?php echo $_SESSION['first-name'] ?> <?php echo $_SESSION['last-name'] ?></p>
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
    <button class="upbtn" onclick="window.location.href='upload-podcast-section.php'">Upload your own podcast here!</button>
    <center>
    <!-- <button type="button" class="btn">Add Book</button></p> -->
    </center>
    <main>
     <div class="row">
      <div class="column">
      <div class="card">
      <div class="fakeimg" style="height:150px;">
      <img src="Example.jpg" alt="Example">
    </div>
      <br>  
      <h2>Podcast Title</h2>
      <h3>Author</h3>
      <center>
      <a href="Viewpage.html"><button class="btn">View</button></a>
      </div>
    </div>

    <div class="column">
      <div class="card">
      <div class="fakeimg" style="height:150px;">
      <img src="Example.jpg" alt="Example">
      </div>
      <br>
      <h2>Podcast Title</h2>
      <h3>Author</h3>
      <center>
      <a href="Viewpage.html"><button class="btn">View</button></a>
      </div>
    </div>
    
    <div class="column">
      <div class="card">
      <div class="fakeimg" style="height:150px;">
      <img src="Example.jpg" alt="Example">
    </div>
      <br>
      <h2>Podcast Title</h2>
      <h3>Author</h3>
      <center>
      <a href="Viewpage.html"><button class="btn">View</button></a>
      </div>
    </div>
    
    <div class="column">
      <div class="card">
      <div class="fakeimg" style="height:150px;">
      <img src="Example.jpg" alt="Example">
    </div>
      <br> 
      <h2>Podcast Title</h2>
      <h3>Author</h3>
      <center>
      <a href="Viewpage.html"><button class="btn">View</button></a>
      </div>
    </div>
  </div>
  </center>
  </main>
  </main>
  </body>
  <center>
  <footer class="site-footer">
              <h6>R - ibrary</h6>
            <ul class="footer-links">
              <li><a href="">About Us</a></li>
              <li><a href="">Contacts</a></li>
              <li><a href="">Help & Support</a></li>
            <h6>‎© Ribrary 2020. All Rights Reserve</h6>
            </ul>
          </div>
        </div>
          </div>
          </div>
        </div>
      </div>
  </html>