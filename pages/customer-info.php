<?php
$host = 'localhost';
$dbUsrname = 'root';
$dbPassword = '';
$dbname = 'project';
$conn = new mysqli($host, $dbUsrname, $dbPassword, $dbname);
$login = true;

session_start();

$admin = $_SESSION['admin-id'];
$customer_id = $_SESSION['cust-id'];
$sql = "SELECT * FROM customer WHERE customer_id='$customer_id'";
$run_query = mysqli_query($conn, $sql);
$customer = mysqli_fetch_array($run_query);

$name = $customer['name'];
$phone = $customer['phone_no'];

$jdate = $customer['join_date'];
$date = substr($jdate, 0, 10);


$sql_bills = "SELECT * FROM bills WHERE customer_id = '$customer_id'";
$bill_query = mysqli_query($conn, $sql_bills);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <title><?php echo $name ?></title>
    <!-- MDB icon -->
    <link rel="icon" href="../img/bracu.ico" type="image/x-icon"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css"/>
    <!-- Google Fonts Roboto -->
    <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="../css/mdb.min.css"/>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
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
                        <a class="nav-link active" href="cart.php">Cart</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="products.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout-customer.php">Logout-Customer</a>
                </li>
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
                <div class="col-xl-4">


                    <!-- Start your project here-->
                    <h1> Customer Info</h1>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Name</td>
                            <td><?php echo $name ?></td>
                        </tr>
                        <tr>
                            <td>Phone No</td>
                            <td><?php echo $phone ?></td>
                        </tr>
                        <tr>
                            <td>Join Date</td>
                            <td><?php echo $date ?></td>
                        </tr>
                        </tbody>
                    </table>

                    <br>
                    <br>
                    <h2>Billing History</h2>

                    <table>
                        <thead>
                        <tr>
                            <th>Bill Id</th>
                            <th>Paid Amount</th>
                            <th>Payment Method</th>
                        </tr>
                        </thead>

                        <?php while ($bill = $bill_query->fetch_assoc()) { ?>

                            <tr>
                                <td> <?php echo $bill['bill_id'] ?> </td>
                                <td>
                                    <?php
                                    $bill_id = $bill['bill_id'];
                                    $sql_command = "SELECT SUM(pro.price*quantity) as paid FROM added_to as cart INNER JOIN products as pro ON cart.product_id = pro.product_id WHERE cart.cart_id =(SELECT made_for FROM billing WHERE bill_id='$bill_id')";
                                    $run_sql_command = mysqli_query($conn, $sql_command);
                                    $result = $run_sql_command->fetch_assoc();
                                    $paid = $result['paid'];
                                    echo $paid;
                                    ?>
                                </td>
                                <td>

                                    <?php
                                    $sql_command_2 = "SELECT * FROM payment WHERE bill_id='$bill_id'";
                                    $run_sql_command_2 = mysqli_query($conn, $sql_command_2);
                                    $result_2 = $run_sql_command_2->fetch_assoc();
                                    $pay = $result_2['payment_method'];
                                    echo $pay;
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>


                    <div class="justify-content-center">
                        <br>
                        <br>
                        <br>
                        <br>
                        <button type="button" class="btn btn-primary btn-rounded" onclick=location.href="products.php">
                            Go Shopping

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
