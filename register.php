<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "beats_social"); // Connection variable

if(mysqli_connect_errno())
{
  echo "failed to connect: " . mysqli_connect_errno();
}

// Declaring variables to prevent errors
$fname = "";
$lname = "";
$em = ""; //email
$em2 = "";
$username = "";
$password = "";
$password2 = "";
$date = "";
$error_array = array(); //holds error messages


// if submit is pressed..
if(isset($_POST['reg_button'])){
  // First Name
  $fname = strip_tags($_POST['reg_fname']);// registration form values (strip_tags removes html tags for security)
  $fname = str_replace(' ', '', $fname);// Remove whitespace
  $fname = ucfirst(strtolower($fname));// Capitalize only first letter
  $_SESSION['reg_fname'] = $fname; //Stores first name into session variable

  // Last Name
  $lname = strip_tags($_POST['reg_lname']); // registration form values (strip_tags removes html tags for security)
  $lname = str_replace(' ', '', $lname); // Remove whitespace
  $lname = ucfirst(strtolower($lname)); // Capitalize only first letter
  $_SESSION['reg_lname'] = $lname; //Stores last name into session variable
  
  // Email 1
  $em = strip_tags($_POST['reg_email']); // registration form values (strip_tags removes html tags for security)
  $em = str_replace(' ', '', $em); // Remove whitespace
  $em = strtolower($em); // all lower case
  $_SESSION['reg_email'] = $em; //Stores email 1 into session variable

  // Email 2
  $em2 = strip_tags($_POST['reg_email2']); // registration form values (strip_tags removes html tags for security)
  $em2 = str_replace(' ', '', $em2); // Remove whitespace
  $em2 = strtolower($em2); // all lower case

  $username = strip_tags($_POST['reg_username']);
  $username = str_replace(' ', '', $username);
  $_SESSION['reg_username'] = $username;

  // Password
  $password = strip_tags($_POST['reg_password']); // registration form values (strip_tags removes html tags for security)
  $password2 = strip_tags($_POST['reg_password2']); // registration form values (strip_tags removes html tags for security)

  $date = date("Y-m-d"); // Current date

  if($em == $em2) {
    if(filter_var($em, FILTER_VALIDATE_EMAIL)) {
      $em = filter_var($em, FILTER_VALIDATE_EMAIL);

      // check if email already exists
      $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

      // count the number of rows returned
      $num_rows = mysqli_num_rows($e_check);

      if($num_rows > 0) {
        array_push($error_array, "Email already in use<br>");
      }
    } else {
      array_push($error_array, "Invalid email format<br>");
    }
  } else {
     array_push($error_array, "Emails don't match<br>");
  }

  if(strlen($fname) > 25 || strlen($fname) < 2) {
      array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
  }

  if(strlen($lname) > 25 || strlen($lname) < 2) {
      array_push($error_array, "Your last name must be between 2 and 25 characters<br>");
  }

  if(strlen($username) > 25 || strlen($username) < 5) {
      array_push($error_array, "Your username must be between 5 and 25 characters<br>");
  } else if (preg_match('/[^A-Za-z0-9]/', $username)) {
      array_push($error_array, "Your username can only contain English characters or numbers<br>");
    } else {
      // check if username already exists
      $u_check = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

      // count the number of rows returned
      $num_rows2 = mysqli_num_rows($u_check);

      if($num_rows2 > 0) {
        array_push($error_array, "Username already in use<br>");
      }

      // Profile pic assignment
      $profile_pic = "";
    }
  }


  if($password != $password2) {
    array_push($error_array, "Passwords don't match<br>");
  } else {
    if(preg_match('/[^A-Za-z0-9]/', $password)) {
      array_push($error_array, "Your password can only contain English characters or numbers<br>");
    }
  }

  if(strlen($password) > 30 || strlen($password) < 5) {
    array_push($error_array, "Your password must be between 5 and 30 characters<br>");
  }

  if(empty($error_array)) {
    $password = md5($password); //Encrypt password before sending to database
}

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
      <!-- <?php include "navbar.php" ?> -->
      <div class="row main">
        <div class="main-login main-center">
        <h5>Sign up now -- it's free!</h5>
          <form action="register.php" method="POST" role="form">
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
                  <?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "<p style='color: #ff0033'>Your first name must be between 2 and 25 characters</p><br>" ?>
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
                <?php if(in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "<p style='color: #ff0033'>Your last name must be between 2 and 25 characters</p><br>" ?>
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
                <?php if(in_array("Email already in use<br>", $error_array)) echo "<p style='color: #ff0033'>Email already in use</p><br>";
                  else if(in_array("Invalid email format<br>", $error_array)) echo "<p style='color: #ff0033'>Invalid email format</p><br>";
                  else if(in_array("Emails don't match<br>", $error_array)) echo "<p style='color: #ff0033'>Emails don't match</p><br>";
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
                <?php if(in_array("Username already in use<br>", $error_array)) echo "<p style='color: #ff0033'>Username already in use"; ?>
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
                <?php if(in_array("Your password can only contain English characters or numbers<br>", $error_array)) echo "<p style='color: #ff0033'>Your password can only contain English characters or numbers</p><br>";
                  else if(in_array("Your password must be between 5 and 30 characters<br>", $error_array)) echo "<p style='color: #ff0033'>Your password must be between 5 and 30 characters</p><br>"; ?>
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
                <?php if(in_array("Passwords don't match<br>", $error_array)) echo "<p style='color: #ff0033'>Passwords don't match</p><br>" ?>
              </div>
            </div>

            <div class="form-group">
              <input type="submit" name="reg_button" value="Register">
            </div>
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