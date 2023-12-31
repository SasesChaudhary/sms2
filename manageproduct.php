<!DOCTYPE html>
<?php 
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('location:login.php');
    }
?>
<?php
	include 'includes/connection.php';

    if(isset($_POST['add'])){
      $name = $_POST['name'];
      $bought = $_POST['bought'];
      $sold = $_POST['sold'];
      $stock = $_POST['stock'];

      $imagename = $_FILES['image']['name'];
      $tmpname = $_FILES['image']['tmp_name'];
      $img_type = strtolower(pathinfo($imagename,PATHINFO_EXTENSION));//gets extension of the image
      $destination = "./images/".$imagename;//Saves image
      $allow_type= array('png','jpeg','jpg');//restriction of png jpeg and jpg
      $imagesize = $_FILES['image']['size'];//file size


      //image validation
      if(in_array($img_type, $allow_type)){//checks image extension
        if($imagesize <= 2000000){//checks image size
          move_uploaded_file($tmpname, $destination);//moves the image to project image folder
            $insertquery = "INSERT INTO product(product_name, product_bought, product_sold, product_stock, product_image) VALUES('{$name}','{$bought}','{$sold}','{$stock}','$imagename')";
            $query = mysqli_query($con,$insertquery);
        }
        else{
          echo "Size exceded";
        }
      }
      else{
        echo "file type Not allowed";
      }

    }
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<title>Stationery Management System</title>

	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/add.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
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

<!-- Main Content -->
<main >
    <h1 class="title">Product</h1>
    <ul class="breadcrumbs">
        <li><a href="admin_dashboard.php">Home</a></li>
        <li class="divider">/</li>
        <li><a href="product.php" class="active">Product</a></li>
    </ul>
    <div class="content">
    <section class="modal">
            <button class="modal__button">
                <a href="addproduct.php"> Add Product </a>
            </button>
        </section>
        <div class="table">
            <section class="table_body">
                <table id="table" class="display" style="width:100%">
                    <?php
                        include 'includes/connection.php';

                    ?>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Rate (R.S) </th>
                            <th>Quantity</th>
                            <th>Product Added</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM product ORDER BY product_id DESC";
                            $result = mysqli_query($con,$query);
                            
                            while($row= mysqli_fetch_array($result)){
                                $id = $row['product_id'];
                                $name = $row['product_name'];
                                $bought = $row['product_bought'];
                                // $sold = $row['product_sold'];
                                $stock = $row['product_stock'];
                                $image = $row['product_image'];
                                $time = $row['product_add_date'];
                        
                            ?>
                            <tr>
                                <td><?php  echo $name?></td>
                                <td><img src="<?php echo "images/".$row['product_image']; ?>" alt="image" width="100px" height="100px"></td>
                                <td><?php  echo $bought ?></td>
                                <td><?php  echo $stock ?></td>
                                <td><?php  echo $time ?></td>
                                <td><a href="./updateproduct.php?id=<?php echo $id; ?>"><i class='bx bx-edit' style="font-size:25px;color:green;"></i></a><a onclick="return confirm('Are you sure you want to delete?')" href="./deleteproduct.php?id=<?php echo $id; ?>"><i class='bx bxs-message-square-x' style="font-size:25px;color:red;"></i></a></td>
                            </tr>
                    <?php
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
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#table').DataTable();
        });
    </script>
</body>
</html>    