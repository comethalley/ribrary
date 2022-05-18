<?php
session_start();
if (isset($_SESSION["id"])) {

  include '../includes/autoload-class.php';

  $user = new User();
  $data = $user->emailExist($_SESSION["email"]);
} else {
  header('Location: Login-and-Signup-page.html');
  exit();
}

if(isset($_POST['cancel-membsership'])){

  $user->updateSubscription($_SESSION["id"],'not subscribed');
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
  <title>Upload Documents</title>
  <!--BOOTSTRAP-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

  <!-- SWEET ALERT -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
  <nav class="navbar sticky-top navbar-expand-lg navbar-dark mx-0 w-100" style="background-color: #485665;">
    <a class="navbar-brand" href="books-section.php">
      <img src="img/ribrary-logo-white.png" width="50" height="50" class="d-inline-block" alt="logo.png">
      Ribrary
    </a>
  </nav>

  <main>
    <?php
    if ($data['subscription'] !== "subscribed") {
    ?>
      <!-- NOT SUBSCRIBED  -->
      <div class="container1 my-5">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1 class="display-3 text-dark">Start your membership today!</h1>
            <p class="lead text-muted">Pay as low as 129 pesos !</p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-9 mx-auto">
            <div class="card" style="width: 100%">
              <div class="card-body">
                <p class="card-text">By starting your membership you will have an acess to our premium content. You can cancel anytime from your account setting </p>
                <a href="payment.php" class="btn btn-outline-primary btn-lg btn-block">Credit or Debit Card</a>
                <p class="card-text lead text-muted mt-5">Cancel Anytime.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    <?php
    } else {
    ?>
      <!-- ----------------------------------------------------- -->
      <!--  SUBSCRIBED -->
      <div class="container1 my-5">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1 class="display-3 text-dark">Subscribed</h1>
            <p class="lead text-muted">Pay as low as 129 pesos !</p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-9 mx-auto">
            <div class="card" style="width: 100%">
              <div class="card-body">
                <p class="card-text">By starting your membership you will have an acess to our premium content. You can cancel anytime from your account setting </p>
                <button type="button" class="btn btn-outline-primary btn-lg btn-block" data-toggle="modal" data-target="#staticBackdrop">
                  Cancel membership
                </button>
                <p class="card-text lead text-muted mt-5">Cancel Anytime.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="membership.php" method="POST">
              <div class="modal-body">
                Are your sure you want to cancel membership?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="cancel-membsership" class="btn btn-primary">Yes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
    <!-- -------------------------------------------- -->


  </main>
  <script>
    // GET THE URL
    const url = window.location.search
    const urlParam = new URLSearchParams(url)
    const parameter = urlParam.get('q')

    if (parameter && parameter == 'success') {
      Swal.fire({
        icon: 'success',
        title: 'Subscribed',
        text: 'Something went wrong!',
      })
    }
  </script>
</body>

</html>