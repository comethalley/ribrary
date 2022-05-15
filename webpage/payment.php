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
  <title>Payment</title>
  <!--BOOTSTRAP-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</head>

<body>  
  <main>
      <div class="container1 my-5">
          <div class="row">
                <div class="col-md-9 mx-auto">
                    <div class="card" style="width: 100%">
                        <div class="card-body">
                          <form>
                            <div class="form-group row">
                                <img src="img/aerol.jpg" class="rounded-circle" alt="cover" style = "width:100px; height:100px;">
                                <p>User Account</p>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Credit Card Info</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Card Holder</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Billing Address</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="name">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg float-right">Continue</button>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
      </div>
  </main>
</body>

</html>