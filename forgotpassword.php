<!-- 
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
</html> -->




<!DOCTYPE html>
<?php
session_start();
if(isset($_POST['reset'])){
    $email = $_POST["email"];
    
    // Chec email exists in database
    $mysqli = include 'includes/connection.php';
    $stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // Email exists, display the password reset 
        ?>
        <html lang="en">
        <head>
            <!-- Head content here -->
        </head>
        <body>
        <div class="container">
            <div class="form-container">
                <div class="title"><span>Reset Password</span></div>
                <form action="forgotpassword.php" method="POST">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                    <div class="row">
                        <i class="fas fa-key"></i>
                        <input type="password" placeholder="Enter New Password" name="new_password">
                    </div>
                    <div class="row">
                        <i class="fas fa-key"></i>
                        <input type="password" placeholder="Confirm New Password" name="confirm_password">
                    </div>
                    <div class="row button">
                        <input type="submit" value="Reset Password" name="submit">
                    </div>
                </form>
            </div>
        </div>
        </body>
        </html>
        <?php
    } else {
        // Email does not exist in the database
        echo "The provided email address does not exist.";
    }
} elseif (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];
    
    if ($newPassword !== $confirmPassword) {
        echo "Passwords do not match.";
        exit;
    }
    
    // Update the password in the database
    $mysqli = include 'includes/connection.php';
    $stmt = $mysqli->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $newPassword, $email);
    $stmt->execute();
    
    echo "Password has been successfully reset.";
}
?>
<html lang="en">
<head>
    <!-- Head content here -->
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
        </form>
    </div>
</div>
</body>
</html>