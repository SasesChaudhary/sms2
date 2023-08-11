<!DOCTYPE html>
<?php

session_start();
if(isset($_SESSION['username'])){
  header('location:user_dashboard.php');
}
include 'includes/connection.php';
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
  
    //checking of emial and password in database
    $check = "SELECT * FROM users WHERE username='$username'  ";
    $query = mysqli_query($con,$check);
    $row = mysqli_num_rows($query);
  
    if($row == 1){

      while($row= mysqli_fetch_array($query)){
        $_SESSION['id'] = $row['user_id'];
        $password = $row['password'];
        $cpassword = $row['cpassword'];
      }
      header('location:updatepassword.php');
  
    }
    else{
      $error = 'Please enter correct username and email';
    }
}
?>
<html lang="en">
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/form.css">
</head>
<body style="background-image:url(assets/images/forgot.jpg);background-repeat:no-repeat;background-position:center;background-size:cover;height:100vh;width:100%;">
<div class="container">
      <div class="form-container">
        <div class="title"><span>Forgot Password</span></div>
        <form action="" method="POST">
        <p>
                <?php
                if(isset($error)){
                    echo $error;
                }
                ?>
            </p>
          <div class="row">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Username" name="username">
          </div>
          <div class="row">
          <i class="fa fa-envelope" aria-hidden="true"></i>
            <input type="text" placeholder="Email" name="email">
          </div>
          <div class="row button">
            <input type="submit" value="Submit" name="login" >
          </div>
          <div class="signup-link">Already have an account? <a href="login.php">Login now</a></div>
        </form>
      </div>
    </div>
</body>
</html>