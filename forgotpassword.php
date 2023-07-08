
<!DOCTYPE html>
<?php
session_start();
if(isset($_POST['reset'])){
    $email = $_POST["email"];
    $token = bin2hex(random_bytes(16));
    
    $token_hash = hash("sha256", $token);
    
    $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

    $sql = "UPDATE users SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?";

    $mysqli = include 'includes/connection.php';
    
    $stmt = $mysqli->prepare($sql);

    $stmt->bind_param("sss", $token_hash, $expiry, $email);

    $stmt->execute();
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
        <div class="title"><span>Reset Password</span></div>
        <form action="forgotpassword.php" method="POST">
        <p>
                <?php
                if(isset($error)){
                    echo $error;
                }
                ?>
            </p>
          <div class="row">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Enter Email Address" name="email">
          </div>
          <div class="row button">
            <input type="submit" value="Submit" name="reset">
          </div>
          <div class="signup-link">Already have an account? <a href="login.php">Login now</a></div>
      </div>
    </div>
</body>
</html>