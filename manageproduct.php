<?php include 'layouts/header.php' ; ?>

<!-- Main Content -->
<main >
    <h1 class="title">Product</h1>
    <ul class="breadcrumbs">
        <li><a href="index.php">Home</a></li>
        <li class="divider">/</li>
        <li><a href="product.php" class="active">Product</a></li>
    </ul>
    <div class="content">
        <div class="table">
            <section class="table_body">
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Market Price</th>
                            <th>Selling Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Dom's Pencil</td>
                            <td><img src="assets/images/pencil1.jpg" alt=""></td>
                            <td>Pencil</td>
                            <td>Active</td>
                            <td>5</td>
                        </tr>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</main>
<!-- Main Content -->


<?php include 'layouts/footer.php' ; ?>
    