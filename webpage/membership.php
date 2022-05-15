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
  <nav class="navbar sticky-top navbar-expand-lg navbar-dark mx-0 w-100" style="background-color: #485665;">
    <a class="navbar-brand" href="books-section.php">
      <img src="img/ribrary-logo-white.png" width="50" height="50" class="d-inline-block" alt="logo.png">
      Ribrary
    </a>
  </nav>
  
  <main>
      <div class="container1 my-5">
          <div class="row">
              <div class="col-md-12 text-center">
                <h1 class="display-3 text-dark">Start your membership today!</h1>
                <p class = "lead text-muted">Pay as low as 129 pesos !</p>
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
  </main>
</body>

</html>