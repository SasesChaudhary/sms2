<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['username'])){
	header('location:login.php');
}
include './includes/connection.php';
$id = $_SESSION['user_id'];

?>
<html lang="en">
<head>
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/add.css">
	<title>Stationery Management System</title>
</head>
<body>
	
    <!-- SIDEBAR -->
	<section id="sidebar"> 
		<?php 
			if($_SESSION['user_type'] == 1){
				include 'layouts/user_menu.php';
			}
			else{
				header( 'location:admin_dashboard.php');
			}
		?>

  <!-- Main Content -->
  <main >
    <h1 class="title">Dashboard</h1>
    <ul class="breadcrumbs">
        <li><a href="user_dashboard.php">Home</a></li>
        <li class="divider">/</li>
        <li><a href="user_dashboard.php" class="active">dashboard</a></li>
    </ul>
	
  </main>
  <!-- Main Content -->


</section>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="assets\js\dashboard.js"></script>
</body>
</html>