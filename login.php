<!DOCTYPE html>
<?php
include 'includes/connection.php';
if(isset($_POST['login'])){
  $email = $_POST['email'];
  $pass = $_POST['password'];

  //checking of emial and password in database
  $check = "SELECT * FROM users WHERE email = '$email' && password='$pass'";
  $query = mysqli_query($con,$check);
  $row = mysqli_num_rows($query);

  $fetch = mysqli_fetch_array($query);
  if($row == 1){
    $username = $fetch['username'];
    $user_type = $fetch['user_type'];
    session_start();

    $_SESSION['username'] = $username;
    $_SESSION['user_type'] = $user_type;

    header('location:index.php');

  }
  else{
    $error = 'Invalid email and password';
  }
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/form.css">
</head>
<body>
<div class="container">
      <div class="form-container">
        <div class="title"><span>Login Form</span></div>
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
            <input type="text" placeholder="Email" name="email">
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password">
          </div>
          <div class="row button">
            <input type="submit" value="Login" name="login">
          </div>
          <div class="signup-link">Don't have an account? <a href="register.php">Register now</a></div>
        </form>
      </div>
    </div>
</body>
</html>