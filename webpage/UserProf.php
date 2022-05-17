<?php
session_start();

if (!isset($_SESSION['id'])) {
  header("Location:user-login.php");
} else {
  include '../includes/autoload-class.php';
  include 'view-functions.php';
  $user = new User();

  $userdata = $user->emailExist($_SESSION["email"]);
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
  <!-- <link rel="stylesheet" href="css/book-section.css"> -->
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/UserProf.css">
  <title>User profile</title>

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

    .hide {
      display: none;
    }
  </style>
</head>

<body>
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

  <div class="container1 my-5 p-5">
    <div class="row">
      <div class="col-4 text-white p-5 text-center" style="background-color: #485665;">
        <img src="../functions/uploads/<?php echo $userdata['user_profile'] ?>" class="rounded-circle" alt="cover" style="width:250px; height:250px;">

        <div>
          <form action="../functions/udpateProfile-function.php" method="POST" enctype="multipart/form-data">
            <button type="button" class="btn btn-light btn-sm my-2 change-profile">Change profile</button>
            <input type="file" name="file" accept=".jpg, .png" class="hide" id="change-input" required>
            <br>
            <button name="update-profile" class="update-button hide">Update</button>
          </form>
        </div>

      </div>
      <div class="col-8 border">
        <p class="display-4 text-center">Information</p>
        <hr>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="firstname">Firstname</label>
            <input type="text" class="form-control" id="firstname" placeholder="<?php echo $userdata['firstname'] ?>" disabled>
          </div>
          <div class="col">
            <label for="lastname">Lastname</label>
            <input type="text" class="form-control" id="lastname" placeholder="<?php echo $userdata['lastname'] ?>" disabled>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="<?php echo $userdata['Username'] ?>" disabled>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" placeholder="<?php echo $userdata['address'] ?>" disabled>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-12">
            <fieldset class="form-group row">
              <legend class="col-form-label col-sm-2 float-sm-left pt-0">Gender</legend>
              <div class="col-sm-10">
                <p><?php echo $userdata['gender'] ?></p>
              </div>
            </fieldset>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="address">Contact Number</label>
            <input type="text" class="form-control" id="address" placeholder="<?php echo $userdata['contact_no'] ?>" disabled>
          </div>
        </div>

        <button type="button" class="btn btn-primary btn-sm mr-5 my-5" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Edit profile</button>

        <!-- MODAL -->
        <form action="../functions/udpateProfile-function.php" method="POST">
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>


                <div class="modal-body">

                  <div class="form-row">
                    <div class="col-6">
                      <label for="firstname" class="col-form-label">Firstname:</label>
                      <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $userdata['firstname'] ?>" required>
                    </div>

                    <div class="col-6">
                      <label for="lastname" class="col-form-label">Lastname:</label>
                      <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $userdata['lastname'] ?>" required>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="email" class="col-form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $userdata['Username'] ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="address" class="col-form-label">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $userdata['address'] ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="contact_no" class="col-form-label">Address:</label>
                    <input type="text" class="form-control" id="contact_no" name="contact_no" value="<?php echo $userdata['contact_no'] ?>" required>
                  </div>

                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button name="submit" type="submit" class="btn btn-primary">Save changes</button>
                </div>

              </div>
            </div>
          </div>
        </form>
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
  <script>
    const changeProfile = document.querySelector('.change-profile')
    const changeInput = document.querySelector('#change-input')

    changeProfile.addEventListener('click', function() {
      changeInput.classList.remove('hide')
      changeInput.click()
      changeProfile.classList.add('hide')
      document.querySelector('.update-button').classList.remove('hide')
    })

    const url = window.location.search
    const urlParam = new URLSearchParams(url)
    const success = urlParam.get('q')

    if (success && success == 'success') {
      Swal.fire({
        icon: 'success',
        title: 'Updated Succesfully!',
        text: 'Your profile has been updated.',
      })
    }
  </script>
</body>

</html>