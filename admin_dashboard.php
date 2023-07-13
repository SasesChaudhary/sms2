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
				include 'layouts/admin_menu.php';
			}
		?>

  <!-- Main Content -->
  <main >
    <h1 class="title">Dashboard</h1>
    <ul class="breadcrumbs">
        <li><a href="admin_dashboard.php">Home</a></li>
        <li class="divider">/</li>
        <li><a href="admin_dashboard.php" class="active">dashboard</a></li>
    </ul>
	<div class="info-data">
		<div class="card">
			<div class="head">
				<div class="items">
					<h2>Users</h2>
					<?php
						$check_user = "SELECT * FROM users ";
						$query_user = mysqli_query($con,$check_user);
						$row = mysqli_num_rows($query_user);
					?>
					<p><?php  echo $row;?></p>
				</div>
				<i class='bx bx-user' style="color:blue;"></i>
			</div>
		</div>
		<div class="card">
			<div class="head">
				<div>
					<h2>Products</h2>
					<?php
						$check_product = "SELECT * FROM product ";
						$query_product = mysqli_query($con,$check_product);
						$row_product = mysqli_num_rows($query_product);
					?>
					<p><?php echo $row_product;?></p>
				</div>
				<i class='bx bxs-doughnut-chart icon' style="color:green;"></i>
			</div>
		</div>
		<div class="card">
			<div class="head">
				<div>
					<h2>Sales</h2>
					<p>1</p>
				</div>
				<i class='bx bxs-chart icon' style="color:purple;"></i>
			</div>
		</div>
	</div>
  </main>
  <!-- Main Content -->


</section>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="assets\js\dashboard.js"></script>
</body>
</html>