<?php
include 'includes/connection.php';
$id = $_GET['id'];
$query = "DELETE FROM product WHERE product_id='$id' ";
$data = mysqli_query($con, $query);

// Check if the deletion was successful
if ($data) {
    ?>
    <script type="text/javascript">
        // Display a success alert
        alert("Data Deleted Successfully");
    </script>
    <?php
    // Redirect to the product management page
    header('location:manageproduct.php');
} else {
    // Handle the case where deletion fails
    echo "Error: Unable to delete data.";
}
?>
