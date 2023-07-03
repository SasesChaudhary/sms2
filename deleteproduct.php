<?php
    include 'includes/connection.php';
    $id=$_GET['id'];
    $query = "DELETE FROM product WHERE product_id='$id' ";
    $data= mysqli_query($con, $query);
    if($data){
        ?>
        <script type="text/javascript">
            alert("Data Deleted Successfully")
        </script>
        <?php
        header('location:manageproduct.php');
    }

?>