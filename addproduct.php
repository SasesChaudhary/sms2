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
      $filename = strtolower(pathinfo($imagename,PATHINFO_FILENAME));//gets imagename
      $filedate = $filename.date('sidmY').".".$img_type;//adds date in the picture
      $filechange = preg_replace('/\s+/','',$filedate);//removes white spaces
      $allow_type= array('png','jpeg','jpg');//restriction of png jpeg and jpg
      $imagesize = $_FILES['image']['size'];//file size
      $destination = "./images/".$filechange;//changes image name

      //image validation
      if(in_array($img_type, $allow_type)){//checks image extension
        if($imagesize <= 2000000){//checks image size
          move_uploaded_file($tmpname, $destination);//moves the image to project image
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
	<!-- <link rel="stylesheet" href="assets/css/style.css"> -->
	<title>Stationery Management System</title>
</head>
<body>
	
    <!-- SIDEBAR -->
	<section id="sidebar"> 
		<?php 
			// if($_SESSION['user_type'] == 1){
			// 	include 'layouts/user_menu.php';
			// }
			// else{
			// 	include 'layouts/admin_menu.php';
			// }
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
          <div class="row">
            <label for="">Product Name</label>
            <input type="text" name="name">
          </div>
          <div class="row">
          <label for="">Product Image</label>
            <input type="file"  name="image">
          </div>
          <div class="row">
          <label for="">Product Bought</label>
            <input type="number" name="bought">
          </div>
          <div class="row">
          <label for="">Product Sold</label>
            <input type="number" name="sold">
          </div>
          <div class="row">
          <label for="">Stock</label>
            <input type="number" name="stock">
          </div>
          <div class="row button">
            <input type="submit" value="Add Product" name="add">
          </div>
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