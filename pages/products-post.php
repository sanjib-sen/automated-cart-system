<?php

$host = 'localhost';
$dbUsrname = 'root';
$dbPassword = '';
$dbname = 'project';
$conn = new mysqli($host, $dbUsrname, $dbPassword, $dbname);


session_start();
$product_id = $_POST['product_id'];
$action = '';
$label = '';
if (isset($_POST['add'])) {
    $action = "add";
}
if (isset($_POST['update'])) {
    $action = "update";
    $update_sql = "SELECT * FROM products where product_id=$product_id";
    $run_query_update = mysqli_query($conn, $update_sql);
    $product = $run_query_update->fetch_assoc();
}
if (isset($_POST['delete'])) {
    $action = "delete";
    $del_sql = "DELETE FROM products where product_id=$product_id";
    $run_del_query = mysqli_query($conn, $del_sql);
    $label = "The product has been deleted.";
}


$sql = "SELECT * FROM products";
$run_query = mysqli_query($conn, $sql);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <title>Material Design for Bootstrap</title>
    <!-- MDB icon -->
    <link rel="icon" href="../img/mdb-favicon.ico" type="image/x-icon"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css"/>
    <!-- Google Fonts Roboto -->
    <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="../css/mdb.min.css"/>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button
                class="navbar-toggler"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#navbarRightAlignExample"
                aria-controls="navbarRightAlignExample"
                aria-expanded="false"
                aria-label="Toggle navigation"
        >
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse " id="navbarRightAlignExample">
            <!-- Left links -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if ($_SESSION['role'] == 'admin') { ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="login-register.html">Customer
                            Registration</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="customer-info.php">Customer Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout-customer.php">Logout-Customer</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout-admin.php">Logout-Admin</a>
                </li>
            </ul>
            <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->


<div class="border border-0 p-5">
    <div class="d-flex align-items-center h-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7">

                    <!-- Start your project here-->

                    <?php if ($action == 'add' || $action == 'delete') { ?>

                    <h1>Products</h1>
                    <p>
                        <a href="product-create.php" type="button" class="btn btn-sm btn-success">Add Product</a>
                    </p>


                    <div class="alert alert-success" role="alert">
                        <?php echo $label ?>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Category</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($product = $run_query->fetch_assoc()) { ?>
                                <tr>
                                    <td>
                                        <?php if ($product['image']): ?>
                                            <img src="../uploads/<?php echo $product['image'] ?>"
                                                 alt="<?php echo $product['name'] ?>" class="product-img" height="20"
                                                 width="30">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $product['name'] ?></td>
                                    <td><?php echo $product['price'] ?></td>
                                    <td><?php echo $product['stock'] ?></td>
                                    <td><?php echo $product['category'] ?></td>
                                    <td>
                                        <form action="products-post.php" method="post">
                                            <input type="hidden" name="product_id"
                                                   value="<?php echo $product['product_id'] ?>">
                                            <?php if ($_SESSION['role'] == 'customer') { ?>
                                                <input type="submit" class="btn btn-primary" value="add to cart"
                                                       name="add" required/> <?php } ?>
                                            <input type="submit" class="btn btn-secondary" value="Edit" name="update"
                                                   required/>
                                            <input type="submit" class="btn btn-danger" value="Delete" name="delete"
                                                   required/>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>


<?php if ($action == 'update') { ?>
<div class="border border-0 p-5">
    <div class="d-flex align-items-center h-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7">
                    <form action="product-registration.php" method="POST" enctype="multipart/form-data">

                        <p class="text-center fw-bold ">Update Product</p>

                        <!--          Image Input-->
                        <?php if ($product['image']): ?>
                            <img src="../uploads/<?php echo $product['image'] ?>" alt="<?php echo $product['name'] ?>"
                                 class="product-img" height="40" width="60">
                        <?php endif; ?>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="image">Image</label>
                            <input type="file" id="image" class="form-control" name="image"
                                   aria-describedby="inputGroupFileAddon03"
                                   aria-label="Upload" value="<?php echo $product['image'] ?>"/>
                        </div>

                        <!-- Name input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="title" class="form-control" value="<?php echo $product['name'] ?>"
                                   required/>
                            <label class="form-label" for="title">Name</label>
                        </div>

                        <!-- Phone input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="description" value="<?php echo $product['description'] ?>"
                                   class="form-control" required height=""/>
                            <label class="form-label" for="description">Description</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="number" name="price" value="<?php echo $product['price'] ?>"
                                   class="form-control" required/>
                            <label class="form-label" for="price">Price</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="text" name="category" value="<?php echo $product['category'] ?>"
                                   class="form-control" required height=""/>
                            <label class="form-label" for="category">Category</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="number" name="stock" value="<?php echo $product['stock'] ?>"
                                   class="form-control" required/>
                            <label class="form-label" for="price">Stock</label>
                        </div>

                        <!-- Submit button -->
                        <input type="hidden" name="action" value="updated">
                        <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>">
                        <input type="submit" class="btn btn-primary btn-block mb-4" />
                    </form>
                    <?php } ?>
                    <!-- End your project here-->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MDB -->
<script type="text/javascript" src="../js/mdb.min.js"></script>
<!-- Custom scripts -->
<script type="text/javascript"></script>
</body>
</html>