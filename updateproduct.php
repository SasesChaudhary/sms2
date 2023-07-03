<?php
session_start();
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
<div class="add-form">
    <div class="form-container">
    <form action="" method="POST" enctype="multipart/form-data">
          <div class="row">
            <label for="">Product Name</label>
            <input type="text" name="name" value="<?php echo $name ;?>">
          </div>
          <div class="row">
          <label for="">Product Image</label>
            <input type="file"  name="image" value="<?php  echo $image; ?>">
          </div>
          <div class="row">
          <label for="">Product Bought</label>
            <input type="number" name="bought" value="<?php  echo $bought; ?>">
          </div>
          <div class="row">
          <label for="">Product Sold</label>
            <input type="number" name="sold" value="<?php  echo $sold; ?>">
          </div>
          <div class="row">
          <label for="">Stock</label>
            <input type="number" name="stock" value="<?php  echo $stock; ?>">
          </div>
          <div class="row button">
            <input type="submit" value="Update" name="update">
          </div>
        </form>
      </div>
    </div>
  </main>