<?php

require 'config/config.php';
require 'includes/form_handlers/register_handler.php';


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/register.css">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

    <title>Register</title>
  </head>
  <body>
    <div class="container">
      <?php include "navbar.php" ?>
      <div class="row main">
        <div class="main-login main-center">
        <h5>Sign up now -- it's free!</h5>
          <form action="register.php" method="POST" role="form">
            <div class="form-group">
              <label for="reg_account_type" class="cols-sm-2 control-label">Account Type</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <select class="form-control" name="reg_account_type" id="reg_account_type">
                    <option <?php if($_SESSION['reg_account_type'] == "Rapper") echo "selected"?>>Rapper</option>
                    <option <?php if($_SESSION['reg_account_type'] == "Producer") echo "selected"?>>Producer</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="reg_fname" class="cols-sm-2 control-label">First Name</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="reg_fname" id="reg_fname" placeholder="First Name" value="<?php
                  if(isset($_SESSION['reg_fname'])) {
                    echo $_SESSION['reg_fname'];
                  }
                  ?>" required>
                  <br>
                  <?php if(in_array("Your first name must be between 2 and 25 characters", $error_array)) echo "<p style='color: #ff0033'>Your first name must be between 2 and 25 characters</p>" ?>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="reg_lname" class="cols-sm-2 control-label">Last Name</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="reg_lname" id="reg_lname" placeholder="Last Name" value="<?php
                  if(isset($_SESSION['reg_lname'])) {
                    echo $_SESSION['reg_lname'];
                  }
                  ?>" required>
                </div>
                <br>
                <?php if(in_array("Your last name must be between 2 and 25 characters", $error_array)) echo "<p style='color: #ff0033'>Your last name must be between 2 and 25 characters</p>" ?>
              </div>
            </div>

            <div class="form-group">
              <label for="reg_email" class="cols-sm-2 control-label">Your Email</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                  <input type="email" class="form-control" name="reg_email" id="reg_email" placeholder="Enter your Email" value="<?php
                  if(isset($_SESSION['reg_email'])) {
                    echo $_SESSION['reg_email'];
                  }
                  ?>" required>
                </div>
                <br>
                <?php if(in_array("Email already in use", $error_array)) echo "<p style='color: #ff0033'>Email already in use</p>";
                  else if(in_array("Invalid email format", $error_array)) echo "<p style='color: #ff0033'>Invalid email format</p>";
                  else if(in_array("Emails don't match", $error_array)) echo "<p style='color: #ff0033'>Emails don't match</p>";
                 ?>
              </div>
            </div>

            <div class="form-group">
              <label for="reg_email2" class="cols-sm-2 control-label">Your Email</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                  <input type="email" class="form-control" name="reg_email2" id="reg_email2" placeholder="Confirm your Email" required>
                  <br>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="reg_username" class="cols-sm-2 control-label">Username</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="reg_username" id="reg_username" placeholder="Enter your Username" value="<?php
                  if(isset($_SESSION['reg_username'])) {
                    echo $_SESSION['reg_username'];
                  }
                  ?>" required>
                </div>
                <br>
                <?php if(in_array("Username already in use", $error_array)) echo "<p style='color: #ff0033'>Username already in use"; ?>
              </div>
            </div>

            <div class="form-group">
              <label for="reg_password" class="cols-sm-2 control-label">Password</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                  <input type="password" class="form-control" name="reg_password" id="reg_password" placeholder="Enter your Password" required>
                </div>
                <br>
                <?php if(in_array("Your password can only contain English characters or numbers", $error_array)) echo "<p style='color: #ff0033'>Your password can only contain English characters or numbers</p>";
                  else if(in_array("Your password must be between 5 and 30 characters", $error_array)) echo "<p style='color: #ff0033'>Your password must be between 5 and 30 characters</p>"; ?>
              </div>
            </div>

            <div class="form-group">
              <label for="reg_passsword2" class="cols-sm-2 control-label">Confirm Password</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                  <input type="password" class="form-control" name="reg_password2" id="reg_password2" placeholder="Confirm your Password" required>
                </div>
                <br>
                <?php if(in_array("Passwords don't match", $error_array)) echo "<p style='color: #ff0033'>Passwords don't match</p>" ?>
              </div>
            </div>

            <div class="form-group">
              <input type="submit" name="reg_button" value="Register">
            </div>
            <?php if(in_array("<span>You're all set! Go ahead and log in!</span><br>", $error_array)) echo "<span>You're all set! Go ahead and log in!</span><br>"; ?>
          </form>
        </div>
      </div>
    </div>
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <!-- Popper -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>