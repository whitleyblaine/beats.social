<?php
// Declaring variables to prevent errors
$account_type = "";
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
  // Account type
  $account_type = $_POST['reg_account_type'];
  $_SESSION['reg_account_type'] = $account_type;

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
        array_push($error_array, "Email already in use");
      }
    } else {
      array_push($error_array, "Invalid email format");
    }
  } else {
     array_push($error_array, "Emails don't match");
  }

  if(strlen($fname) > 25 || strlen($fname) < 2) {
    array_push($error_array, "Your first name must be between 2 and 25 characters");
  }

  if(strlen($lname) > 25 || strlen($lname) < 2) {
    array_push($error_array, "Your last name must be between 2 and 25 characters");
  }

  if(strlen($username) > 25 || strlen($username) < 5) {
      array_push($error_array, "Your username must be between 5 and 25 characters");
  } else if (preg_match('/[^A-Za-z0-9]/', $username)) {
    array_push($error_array, "Your username can only contain English characters or numbers");
  } else {
    // check if username already exists
    $u_check = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

    // count the number of rows returned
    $num_rows2 = mysqli_num_rows($u_check);

    if($num_rows2 > 0) {
      array_push($error_array, "Username already in use");
    }
  }


  if($password != $password2) {
    array_push($error_array, "Passwords don't match");
  } else {
    if(preg_match('/[^A-Za-z0-9]/', $password)) {
      array_push($error_array, "Your password can only contain English characters or numbers");
    }
  }

  if(strlen($password) > 30 || strlen($password) < 5) {
    array_push($error_array, "Your password must be between 5 and 30 characters");
  }

  if(empty($error_array)) {
    $password = md5($password); //Encrypt password before sending to database

    // Profile pic assignment
    if($account_type == "Rapper") {
      $profile_pic = "assets/images/microphone.png";
    } else {
      $profile_pic = "assets/images/headphones.png";
    }

    $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',', '$account_type')");

    array_push($error_array, "<span>You're all set! Go ahead and log in!</span><br>");

    // Clear session variables
    $_SESSION['reg_account_type'] = "Rapper";
    $_SESSION['reg_fname'] = "";
    $_SESSION['reg_lname'] = "";
    $_SESSION['reg_email'] = "";
    $_SESSION['reg_email2'] = "";
    $_SESSION['reg_username'] = "";
  }
}

?>