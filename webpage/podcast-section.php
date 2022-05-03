<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location:user-login.php");
} else {
    include '../includes/autoload-class.php';
    $user = new User();
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
    <!-- BOOTSTRAP CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
<div class = "container1">
  <div class = "row text-center py-5">
    <?php
            $data = $user->displayUser();
            $count = 1;
            foreach ($data as $row) {
            ?>
      <div class="col-md-3 col-sm-6 my-2 my-md-3 rounded">
        <div class="card shadow">
          <div>
            <img src="img/book-icon.png" alt="Example" id = "img1">
          </div>
          <div class="card-body">
            <h5 class = "card-title"><?php echo $row["BookName"] ?></h5>
            <h6>
              Ratings
            </h6>
            <h6 class = "author-name">
              <?php echo $row["createdBy"] ?>
            </h6>
            <button class="btn">
                  <a href = "view.html?file=<?php echo $row["BookPath"] ?>">
                    View
                  </a>
            </button>
        </div>
      </div>
    </div>
            <?php
                $count++;
            }
            ?>     
  </div>
</div>
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