<?php
session_start();
$host = 'localhost';
$dbUsrname = 'root';
$dbPassword = '';
$dbname = 'project';
$customer_id = $_SESSION['cust-id'];
$bill = $_SESSION['bill'];
$conn = new mysqli($host, $dbUsrname, $dbPassword, $dbname);

$sql = "SELECT * FROM customer where customer_id = '$customer_id'";
$run_query = mysqli_query($conn, $sql);
$result = $run_query->fetch_assoc();
$customer_name = $result['name'];
$join_date = $result['join_date'];

$year = (int)substr($join_date, 2, 2);

$current_year = (int)substr(date('Y-m-d H:i:s'), 2, 2);

$offer = ((($current_year - $year) * 10) + 1) / 100;
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
                <?php if (isset($_SESSION['cart_count'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="cart.php">Go to Cart</a>
                    </li>
                <?php } ?>
                <?php if ($_SESSION['role'] == 'admin') { ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="login-register.html">Customer
                            Registration</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="customer-info.php">Customer Info</a>
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

                    <h1 class="mb-3 text-center"> Billing Info </h1>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Customer Name</td>
                            <td> <?php echo $customer_name ?> </td>
                        </tr>
                        <tr>
                            <td>Bill</td>
                            <td><?php echo $bill," BDT" ?></td>
                        </tr>
                        <tr>
                            <td>Discount</td>
                            <td><?php echo ($offer * $bill)," BDT" ?></td>
                        </tr>
                        <tr>
                            <td>Total Bill</td>
                            <td><?php echo ($bill - ($offer * $bill))," BDT" ?></td>
                        </tr>
                        <tr>
                            <td>
                                Payment Method
                            </td>
                            <td>
                                <?php if(isset($_POST['payment'])) {
                                 echo $_POST['payment'];
                                } else { ?>
                                <form action="billing.php" method="post">
                                    <label for="method"></label>
                                    <select id="method" name="payment" class="btn-outline-primary" required>
                                        <option value="bkash">Bkash </option>
                                        <option value="nagad">Nagad</option>
                                        <option value="rocket">Rocket </option>
                                        <option value="card">Card</option>
                                        <option value="cash">Cash</option>
                                    </select>
                                </form>
                                <?php } ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <button class="btn-outline-primary" onclick=location.href="billing.php">
                        <?php if(!isset($_POST['payment'])) {
                            echo "Done Shopping";
                        } else {
                            echo "Logout";} ?>
                    </button>

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