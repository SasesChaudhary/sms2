<?php
    include 'includes/connection.php';
    $id=$_GET['id'];
    $query = "DELETE FROM users WHERE user_id='$id' ";
    $data= mysqli_query($con, $query);
    if($data){
        ?>
        <script type="text/javascript">
            alert("Data Deleted Successfully")
        </script>
        <?php
        header('location:usermanagement.php');
    }

?>