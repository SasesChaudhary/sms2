<!DOCTYPE html>
<?php 
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('location:login.php');
    }
	include 'includes/connection.php';
    $id = $_SESSION['user_id'];
    // $sucess = $_SESSION['sucess'];
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
        <li><a href="user_dashboard.php">Home</a></li>
        <li class="divider">/</li>
        <li><a href="userproduct.php" class="active">Product</a></li>
    </ul>
    <!-- <p><?php if(isset($sucess)){echo $sucess;}?></p> -->
    <div class="content">
        <div class="table">
            <section class="table_body">
                <table>
                    <thead >
                        <tr>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Product Rate(R.s)</th>
                            <th>Product Quantity</th>
                            <th>Ordered Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $select_product = mysqli_query($con, "SELECT * FROM purchase_list WHERE user_id='$id' ORDER BY purchase_id DESC");
                        if(mysqli_num_rows($select_product) > 0){
                           while( $fetch_purchase = mysqli_fetch_assoc($select_product)){
                            $p_id= $fetch_purchase['purchase_id'];
                           
                        ?>
                        <tr>
                            <td><?php  echo $fetch_purchase['product_name']?></td>
                            <td><img src="<?php echo "images/".$fetch_purchase['product_image']; ?>" alt="image" width="100px" height="100px"></td>
                            <td><?php  echo $fetch_purchase['product_rate'] ?></td>
                            <td><?php  echo $fetch_purchase['product_quantity'] ?></td>
                            <td><?php echo $fetch_purchase['purchase_date'] ?></td>
                            
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