<?php
echo "hi";
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
$password = "";
$password2 = "";
$date = "";
$error_array = array(); //holds error messages

echo "did it work?";

if(isset($_POST['reg_button'])){

	echo "it worked!";

  // First Name
  $fname = strip_tags($_POST['reg_fname']);// registration form values (strip_tags removes html tags for security)
  $fname = str_replace(' ', '', $fname);// Remove whitespace
  $fname = ucfirst(strtolower($fname));// Capitalize only first letter

  // Last Name
  $lname = strip_tags($_POST['reg_lname']); // registration form values (strip_tags removes html tags for security)
  $lname = str_replace(' ', '', $lname); // Remove whitespace
  $lname = ucfirst(strtolower($lname)); // Capitalize only first letter
  
  // Email 1
  $em = strip_tags($_POST['reg_email']); // registration form values (strip_tags removes html tags for security)
  $em = str_replace(' ', '', $em); // Remove whitespace
  $em = strtolower($em); // all lower case

  // Email 2
  $em2 = strip_tags($_POST['reg_email2']); // registration form values (strip_tags removes html tags for security)
  $em2 = str_replace(' ', '', $em2); // Remove whitespace
  $em2 = strtolower($em2); // all lower case

  // Password
  $password = strip_tags($_POST['reg_password']); // registration form values (strip_tags removes html tags for security)
  $password2 = strip_tags($_POST['reg_password2']); // registration form values (strip_tags removes html tags for security)

  $date = date("Y-m-d"); // Current date

  echo $em;
  echo $em2;

  if($em == $em2) {
    echo "working";
  } else {
     echo "Emails don't match";
  }
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
          <form action="register2.php" method="POST" role="form">
          	<input type="text" name="reg_fname" placeholder="First Name" required>
          	<br>
          	<input type="text" name="reg_lname" placeholder="Last Name" required>
          	<br>
          	<input type="email" name="reg_email" placeholder="Email" required>
          	<br>
          	<input type="email" name="reg_email2" placeholder="Email" required>
          	<br>
          	<input type="password" name="reg_password" placeholder="Password" required>
          	<br>
          	<input type="password" name="reg_password2" placeholder="Password" required>
          	<br>
          	<input type="submit" name="reg_button" value="Register">
          	<br>
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