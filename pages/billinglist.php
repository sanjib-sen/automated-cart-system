<?php
session_start();
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

                    <h2>Invoice</h2>

                    <table>
                        <tr>
                            <th>Bill Date</th>
                            <th>Bill Id</th>
                            <th>Paid Amount</th>
                            <th>Payment Method</th>
                        </tr>
                        <tr>
                            <td>22-03-21</td>
                            <td>01</td>
                            <td>500</td>
                            <td>Bkash</td>
                        </tr>
                        <tr>
                            <td>23-03-21</td>
                            <td>02</td>
                            <td>640</td>
                            <td>Rocket</td>
                        </tr>
                        <tr>
                            <td>23-03-21</td>
                            <td>03</td>
                            <td>990</td>
                            <td>Bkash</td>
                        </tr>
                        <tr>
                            <td>24-04-21</td>
                            <td>04</td>
                            <td>1090</td>
                            <td>Nagad</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>

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