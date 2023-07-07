<!DOCTYPE html>
<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:login.php');
    }
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/table.css">
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
    <h1 class="title">Product</h1>
    <ul class="breadcrumbs">
        <li><a href="index.php">Home</a></li>
        <li class="divider">/</li>
        <li><a href="product.php" class="active">Product</a></li>
    </ul>
    <div class="table-body">
    <table class="styled-table">
    <?php
                        include 'includes/connection.php';

                    ?>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Purchase</th>
                            <th>Sales</th>
                            <th>In Stock</th>
                            <th>Image</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM product";
                            $result = mysqli_query($con,$query);
                            
                            while($row= mysqli_fetch_array($result)){
                                $id = $row['product_id'];
                                $name = $row['product_name'];
                                $bought = $row['product_bought'];
                                $sold = $row['product_sold'];
                                $stock = $row['product_stock'];
                                $image = $row['product_image'];
                        
                            ?>
                            <tr class="active-row">
                                <td><?php  echo $name?></td>
                                <td><?php  echo $bought ?></td>
                                <td><?php  echo $sold ?></td>
                                <td><?php  echo $stock ?></td>
                                <td><img src="<?php echo "images/".$row['product_image']; ?>" alt="image" width="50px" height="50px"></td>
                                <td><a href="./updateproduct.php?id=<?php echo $id; ?>"><i class='bx bx-edit' style="font-size:30px;"></i></a></td>
                                <td><a onclick="return confirm('Are you sure you want to delete?')" href="./deleteproduct.php?id=<?php echo $id; ?>"><i class='bx bxs-message-square-x' style="font-size:30px;"></i></a></td>
                            </tr>
                    <?php
                    }
                    ?>
    </table>
    </div>
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