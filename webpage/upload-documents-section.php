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
  <title>Upload Documents</title>

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
        }else { 
        ?>
           <button class="links"><a href="Login-and-SignUp-page.html">Log In</a></button>
        <?php }?>
      </div>

      <button class="click">...</button>

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
      <a href="books-section.php">Books</a>
    </nav>
  </div>
  
  <main>
    <div class="backdrop">
      <center>
        <!-- <button type="button" class="btn">Add Book</button></p> -->
      </center>
      <main>
        <center>
          <div class="uploadfile">
            <h2>Welcome to Document Upload Page!</h2>
            <h3>Here you can upload your own creations. Try it now!</h3>
            <p>Instructions: Click "Choose File", Find your created work and click "Open"
              (Please note that Documents are the only files allowed to be uploaded), Then click "Upload".</p>

            <br>
            <form action="../functions/upload-document-function.php" method="POST" enctype="multipart/form-data">
              <input type="file" name="file" accept=".doc,.docx,.pdf"">
              <button type=" submit" name="submit"> UPLOAD </button>
            </form>
          </div>
        </center>
      </main>
  </main>
</body>

</html>