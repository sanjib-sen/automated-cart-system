<?php
session_start();
$host = 'localhost';
$dbUsrname = 'root';
$dbPassword = '';
$dbname = 'project';
$conn = new mysqli($host, $dbUsrname, $dbPassword, $dbname);

$cust_id = $_SESSION['cust-id'];
$sql_customer = "SELECT * FROM customer WHERE customer_id = '$cust_id'";
$name_query = mysqli_query($conn, $sql_customer);
$customer = $name_query->fetch_assoc();

$cart_id = $_SESSION['cart_count'];


if (isset($_POST['add'])) {
    $quantity_more = $_POST['quantity'];
    $product_id_here = $_POST['product_id'];
    $sql_update = "UPDATE added_to SET quantity ='$quantity_more' WHERE (cart_id = $cart_id AND product_id= $product_id_here)";
    $run_update = mysqli_query($conn, $sql_update);
}

$sql_cart = "SELECT * FROM added_to WHERE cart_id = '$cart_id'";
$products_query = mysqli_query($conn, $sql_cart);

$bill = 0;

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
                <?php if (isset($_SESSION['cart_count'])){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="billing.php">Go to Billing</a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION['role'] == 'admin') { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login-register.html">Customer
                            Registration</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="customer-info.php">Customer Info</a>
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
                <div class="col-xl-4">


                    <!-- Start your project here-->
                    <h1 class="mb-3 text-center">Cart for <?php echo $customer['name'] ?> </h1>
                    <p>
                        <a href="products.php" type="button" class="btn btn-sm btn-success">Add More</a>
                    </p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Product</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($item = $products_query->fetch_assoc()) {
                                $product_id = $item['product_id'];
                                $sql_product = "SELECT * FROM products WHERE product_id = '$product_id'";
                                $product_query = mysqli_query($conn, $sql_product);
                                $product = $product_query->fetch_assoc();
                                ?>

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
                                    <td>
                                        <form action="cart.php" method="post" class="row gy-2 gx-3 align-items-center">
                                            <input type="hidden" name="product_id"
                                                   value="<?php echo $product['product_id'] ?>">
                                            <?php if ($_SESSION['role'] == 'customer') { ?>
                                                    <div class="col-auto">
                                                        <div class="form-outline">
                                                            <input type="number" value="<?php echo $item['quantity'] ?>"
                                                                   name="quantity" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="form-outline">
                                                            <input type="submit" class="btn btn-primary" value="change"
                                                                   name="add" required/>
                                                        </div>
                                                    </div>
                                            <?php } ?>
                                        </form>
                                    </td>
                                    <td><?php echo($item['quantity'] * $product['price']);
                                        $bill += ($item['quantity'] * $product['price']);
                                        $_SESSION['bill'] =$bill;?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <h4 class="mb-3 text-center">Total Bill <?php echo $bill; ?> </h4>
                    <!-- End your project here-->
                    <button class="btn-outline-primary" onclick=location.href="billing.php">Go to billing</button>
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