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
  <title>Upload Documents</title>
  <!--BOOTSTRAP-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
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
        <li class="nav-item">
          <a class="nav-link" href="books-section.php">Ebook</a>
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
  
  <main>
    <div class="backdrop">
      <center>
        <!-- <button type="button" class="btn">Add Book</button></p> -->
      </center>
      <main>
        
        <div class="container1 bg.light">
          <div class="row">
            <div class="col-md-12">
              <h1 class ="text-center text-dark">Welcome to Upload Research Document Section</h1>
              <h3 class ="text-center text-dark">Here you can upload your own study and let everyone provide a feedback. Try it now !</h3>
              <p class ="text-center text-dark">Instructions: Browse your file and click your research document.
                (Please note that PDF are the only files allowed to be uploaded), Then click "Upload".</p>
            </div>
          </div>
            

            <form class = "mt-5 mx-2" action="../functions/upload-document-function.php" method="POST" enctype="multipart/form-data">

                <!--<input type="file" name="file" accept=".mp4" id="podcast-video" required>-->
                <div class="form-row">
                    <div class="col mx-3 my-5">
                        <div class="custom-file">
                            <input type="file" name="file" accept=".pdf" class="custom-file-input" id="customFile" required>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                </div>

                <fieldset class="form-group row my-5">
                    <legend class="col-form-label col-sm-3 float-sm-left pt-0">What your study all about :</legend>
                    <div class="col-sm-3">
                        <div class="form-check">
                            <input type="radio" id="science" name="categories" value="science" required>
                            <label for="science">Science</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="tehcnology" name="categories" value="tehcnology">
                            <label for="tehcnology">Technology</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="Health" name="categories" value="Health">
                            <label for="mystery">Health</label>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-check">
                            <input type="radio" id="education" name="categories" value="education">
                            <label for="education">Education</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="agriculture" name="categories" value="agriculture">
                            <label for="agriculture">Agriculture</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" id="physics" name="categories" value="physics">
                            <label for="physics">Physics</label>
                        </div>
                    </div>
                </fieldset>
                
                <div class="form-group row mx-3 my-5">
                  <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm ml-auto">Others:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Please specify">
                  </div>
              </div>
                <button class="btn btn-primary float-right mx-5" type="submit" name="submit"> UPLOAD </button>
            </form>
        </div>  

      </main>
    </div>  
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
  </center>   
<!--input file script-->
<script type="application/javascript">
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $('.custom-file-label').html(fileName);
        });
</script>
</body>

</html>