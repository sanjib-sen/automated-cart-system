<?php
$host = 'localhost';
$dbUsrname = 'root';
$dbPassword = '';
$dbname = 'project';
$conn = new mysqli($host, $dbUsrname, $dbPassword, $dbname);
$login = true;

session_start();

$admin = $_SESSION['admin-id'];
$customer_id =$_SESSION['cust-id'];
$sql = "SELECT * FROM customer WHERE customer_id='$customer_id'";
$run_query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($run_query);

$name = $row['name'];
$phone = $row['phone_no'];
$date = $row['join_date'];

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
                    <h1 class="mb-3 text-center"> Customer Info</h1>
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
                <div class="container-sm">
                    <button type="button" class="btn btn-primary btn-rounded" onclick=location.href="bills.php">See bills
                    </button>
                    <button type="button" class="btn btn-primary btn-rounded" onclick=location.href="products.php">Go Shopping
                    </button>
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
