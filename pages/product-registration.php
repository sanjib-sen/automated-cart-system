<?php

$host = 'localhost';
$dbUsrname = 'root';
$dbPassword = '';
$dbname = 'project';
$conn = new mysqli($host, $dbUsrname, $dbPassword, $dbname);

session_start();

$title = mysqli_real_escape_string($conn, $_POST['title']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$price = mysqli_real_escape_string($conn, $_POST['price']);
$stock = mysqli_real_escape_string($conn, $_POST['stock']);
$category = mysqli_real_escape_string($conn, $_POST['category']);

$label = '';


if(!$_FILES['image']['name']==""){
    $filename = (uniqid($_FILES['image']['name'], true));
    move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/" . $filename);
}

if ($_POST['action']=='registered'){
    $sql_create = "INSERT INTO products (name,description, price, image, stock, category) VALUES ('$title','$description','$price','$filename', '$stock', '$category')";
    $run_query_create = mysqli_query($conn, $sql_create);

    $sql_2 = "SELECT * FROM products ORDER BY product_id DESC LIMIT 1";
    $run_2 = mysqli_query($conn, $sql_2);
    $fetch = $run_2->fetch_assoc();
    $product_id = $fetch['product_id'];
    $admin = $_SESSION['admin-id'];


    $sql3 = "INSERT INTO manages (product_id,user_id) VALUES ('$product_id','$admin')";
    $run_query3 = mysqli_query($conn, $sql3);
    $label = 'Product Registered.';
}
if ($_POST['action']=='updated'){

    $product_id = $_POST['product_id'];
    $sql_update = "UPDATE products SET name='$title',description='$description',price='$price',stock='$stock',category='$category' WHERE product_id = '$product_id'";
    $run_query_update = mysqli_query($conn, $sql_update);
    if(isset($filename) && !$filename==""){
        echo $_FILES['image']['name'];
        $sql_image_update = "UPDATE products SET image='$filename' WHERE product_id = '$product_id'";
        $run_query_update_image = mysqli_query($conn, $sql_image_update);
    }
    $label='Product Updated';
//    $label = 'Product Updated.';
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
    <title>BRACU MART</title>
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
                        <a class="nav-link active" aria-current="page" href="login-register.php">Customer
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
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-7">
                    <!-- Start your project here-->
                    <h1>Products</h1>
                    <?php if ($_SESSION['role']!='customer') { ?>
                        <p>
                            <a href="product-create.php" type="button" class="btn btn-sm btn-success">Add Product</a>
                        </p>

                    <?php } ?>

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
                                    <td> <form action="products-post.php" method="post">
                                            <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>">
                                            <?php if($_SESSION['role']=='customer') { ?>
                                                <input type="submit" class="btn btn-primary"  value="add" name="add" required/> <?php  } ?>
                                            <?php if($_SESSION['role']!='customer') { ?>
                                                <input type="submit" class="btn btn-secondary" value="Edit" name="update" required/>
                                                <input type="submit" class="btn btn-danger" value="Delete" name="delete" required/>
                                            <?php  } ?>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

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