<!DOCTYPE html>
<?php
		session_start();
  if(!isset($_SESSION['username'])){
    header('location:login.php');
  }
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
    <h1 class="title">Product</h1>
    <ul class="breadcrumbs">
        <li><a href="index.php">Home</a></li>
        <li class="divider">/</li>
        <li><a href="product.php" class="active">Product</a></li>
    </ul>
    <div class="add-form">
        <div class="form-container">
        <form action="" method="POST" enctype="multipart/form-data">
            <ul class="form-style">
                <li>
                    <label>Product Name</label>
                    <input type="text" name="name" class="field">
                </li>
                <li>
                    <label>Image</label>
                    <input type="file" name="image" class="field-long">
                </li>
                <li>
                    <label>Purchase </label>
                    <input type="number" name="bought" class="field"></li>
                <li>
                    <label>Sold </label>
                    <input type="number" name="sold" class="field">
                </li>
                <li>
                    <label>Stock</label>
                    <input type="number" name="stock" class="field">
                </li>
                <li>
                    <input type="submit" value="Add" name="add">
                </li>
            </ul>
        </form>
      </div>
    </div>
  </main>
  <!-- Main Content -->


</section>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="assets\js\dashboard.js"></script>
</body>
</html>