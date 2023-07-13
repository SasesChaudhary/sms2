<!DOCTYPE html>
<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:login.php');
    }
	include 'includes/connection.php';
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
	<span class="overlay"></span>
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
    <?php
        $select_user = mysqli_query($con, "SELECT * FROM users WHERE user_id='$id'");
        if(mysqli_num_rows($select_user) > 0){
            $fetch_user = mysqli_fetch_assoc($select_user);
        }
        // echo $id;
    ?>
<!-- Main Content -->
<main >
    <h1 class="title">Product</h1>
    <ul class="breadcrumbs">
        <li><a href="index.php">Home</a></li>
        <li class="divider">/</li>
        <li><a href="product.php" class="active">Product</a></li>
    </ul>
    <div class="content">
        <div class="table">
            <section class="table_body">
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Rate</th>
                            <th>Quantity</th>
                            <th>Order</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $select_product = mysqli_query($con, "SELECT * FROM product");
                        if(mysqli_num_rows($select_product) > 0){
                           while( $fetch_product = mysqli_fetch_assoc($select_product)){
                           
                        ?>
                         <tr>
                            <td><?php  echo $fetch_product['product_name']?></td>
                            <td><img src="<?php echo "images/".$fetch_product['product_image']; ?>" alt="image" width="100px" height="100px"></td>
                            <td><?php  echo $fetch_product['product_bought'] ?></td>
                            <td><?php  echo $fetch_product['product_stock'] ?></td>
                            
                        </tr>
                        <?php
                           }
                        }
                        
                    ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</main>
<!-- Main Content -->
</section>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="assets\js\dashboard.js"></script>
</body>
</html>    