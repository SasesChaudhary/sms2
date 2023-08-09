<!DOCTYPE html>
<?php 
    session_start();
    if(!isset($_SESSION['username'])){
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
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/add.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

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

<!-- Main Content -->
<main >
    <h1 class="title">User Management</h1>
    <ul class="breadcrumbs">
        <li><a href="admin_dashboard.php">Home</a></li>
        <li class="divider">/</li>
        <li><a href="usermanagement.php" class="active">User Management</a></li>
    </ul>
    <div class="content">
        <div class="table">
            <section class="table_body">
                <table id="table" class="display" style="width:100%">
                    <?php
                        include 'includes/connection.php';

                    ?>
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM users WHERE user_type='1'";
                            $result = mysqli_query($con,$query);
                            
                            while($row= mysqli_fetch_array($result)){
                                $id = $row['user_id'];
                                $username = $row['username'];
                                $email = $row['email'];
                                $type = $row['user_type'];
                            ?>
                            <tr>
                                <td><?php  echo $username?></td>
                                <td><?php  echo $email ?></td>
                                <td><?php  if($type == 1){
                                                echo "User";
                                            }
                                            else{echo "Admin";} 
                                ?></td>
                                <td><a onclick="return confirm('Are you sure you want to delete?')" href="./deleteuser.php?id=<?php echo $id; ?>"><i class='bx bxs-message-square-x' style="font-size:25px;color:red;"></i></a></td>
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