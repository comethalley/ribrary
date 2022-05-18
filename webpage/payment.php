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



if (isset($_POST['submit'])) {
  $card_info = $_POST['credit-info'];
  $card_holder = $_POST['card-holder'];
  $billing_address = $_POST['billing-address'];

  $user->membership($card_info, $card_holder, $billing_address, $_SESSION["id"]);
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

              <form action="" method="POST">
                <div class="form-group row">
                  <img src="../functions/uploads/<?php echo $data['user_profile'] ?>" class="rounded-circle" alt="cover" style="width:100px; height:100px;">
                  <p>User Account</p>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label">Credit Card Info</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="credit-info" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label">Card Holder</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="card-holder" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-4 col-form-label">Billing Address</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="billing-address" required>
                  </div>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  Continue
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Card Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Are you sure the about the information you submitted?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                      </div>
                    </div>
                  </div>
                </div>

              </form>


            </div>
          </div>
        </div>
      </div>
    </div>
  </main>


</body>

</html>