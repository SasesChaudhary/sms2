<!DOCTYPE html>
<?php 
	session_start();
    if(!isset($_SESSION['username'])){
        header('location:login.php');
    }
?>
<html lang="en">
<head>
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/add.css">
	<title>Stationery Management System</title>
</head>
<body>
<?php
    include 'includes/connection.php';
    $id = $_GET['id'];
    $select = "SELECT * FROM product WHERE product_id='$id'";
    $data=mysqli_query($con,$select);

    while($row= mysqli_fetch_array($data)){
        $id = $row['product_id'];
        $name = $row['product_name'];
        $bought = $row['product_bought'];
        $sold = $row['product_sold'];
        $stock = $row['product_stock'];
        $image = $row['product_image'];

    }

    if(isset($_POST['update'])){
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
            $update = "UPDATE product SET product_name='{$name}', product_bought='{$bought}', product_sold='{$sold}', product_stock='{$stock}', product_image='$imagename' WHERE product_id='{$id}' ";
            $query = mysqli_query($con,$update);

            header('location:manageproduct.php');
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
        <div class="title">Update Product
          </div>
        <ul class="form-style">
                <li>
                    <label>Product Name</label>
                    <input type="text" name="name" class="field" value="<?php echo $name ;?>">
                </li>
                <li>
                    <label>Image</label>
                    <img src="<?php echo "images/".$image; ?>"  height="70px" width="70px">
                    <input type="file" name="image" class="field-img">
                </li>
                <li>
                    <label>Purchase </label>
                    <input type="number" name="bought" class="field" value="<?php  echo $bought; ?>"></li>
                <li>
                    <label>Sold </label>
                    <input type="number" name="sold" class="field" value="<?php  echo $sold; ?>">
                </li>
                <li>
                    <label>Stock</label>
                    <input type="number" name="stock" class="field" value="<?php  echo $stock; ?>">
                </li>
                <li>
                    <input type="submit" value="Update" name="update">
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