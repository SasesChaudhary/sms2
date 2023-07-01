<?php include 'layouts/header.php' ; ?>

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
        <form action="" method="POST">
          <div class="row">
            <input type="text" placeholder="Product Name" name="product_name">
          </div>
          <div class="row">
            <input type="file"  name="image">
          </div>
          <div class="row">
            <input type="number" placeholder="Quantity" name="quantity">
          </div>
          <div class="row">
            <input type="numeber" placeholder="Amount" name="amount">
          </div>
          <div class="row button">
            <input type="submit" value="Add Product" name="add">
          </div>
        </form>
      </div>
    </div>
</main>
<!-- Main Content -->


<?php include 'layouts/footer.php' ; ?>