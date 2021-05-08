<?php
$host = 'localhost';
$dbUsrname = 'root';
$dbPassword = '';
$dbname = 'project';
$conn = new mysqli($host, $dbUsrname, $dbPassword, $dbname);
$login = true;
$loginsucces = true;
$regsucces = true;
$label = "";
session_start();

$admin = $_SESSION['admin-id'];
if (isset($_POST['cusreg'])) {
    if (mysqli_connect_error()) {
        die('Conner Error(' . mysqli_connect_errno() . ')' . mysqli_connect_errno());
    }
    $name = mysqli_real_escape_string($conn, $_POST['registerName']);
    $phone = mysqli_real_escape_string($conn, $_POST['registerNumber']);
    $pass = mysqli_real_escape_string($conn, $_POST['registerPassword']);
    $repass = mysqli_real_escape_string($conn, $_POST['RepeatPassword']);
    if ($pass !== $repass) {
//		echo"Password didn't match";
        $login = false;
        $regsucces = false;
        $label = "Password didn't match";
//        exit();
    }
    $date = date('Y-m-d H:i:s');
    $sql = "SELECT customer_id FROM customer WHERE phone_no = '$phone'";
    $check_query = mysqli_query($conn, $sql);
    $count_no = mysqli_num_rows($check_query);
    if ($count_no > 0) {
        $login = false;
        $regsucces = false;
//        echo "Already registered using this phone number";
        $label = "Already registered using this phone number";
    } else {
        $sql = "INSERT INTO customer (name,phone_no, password,join_date) VALUES ('$name','$phone','$pass','$date')";
        $run_query = mysqli_query($conn, $sql);

        if ($run_query) {
            $sql_new = "SELECT * FROM customer WHERE phone_no='$phone' AND password='$pass'";
            $run_query_new = mysqli_query($conn, $sql_new);
            $count_new = mysqli_num_rows($run_query_new);
            if ($count_new == 1) {
                $row_new = mysqli_fetch_array($run_query_new);
                $customer_id = $row_new['customer_id'];
                $sql2 = "INSERT INTO register (customer_id,user_id) VALUES ('$customer_id','$admin')";
                $run_query2 = mysqli_query($conn, $sql2);
                $_SESSION['cust-id'] = $customer_id;
//                echo "Successfully Registered";
                $regsucces = true;
                $login = false;
                $_SESSION['role']='customer';
            }
        }
    }
}



if (isset($_POST['cuslogin'])) {
    $phone = mysqli_real_escape_string($conn, $_POST['loginNumber']);
    $pass = mysqli_real_escape_string($conn, $_POST['loginPassword']);
    $sql = "SELECT * FROM customer WHERE phone_no='$phone' AND password='$pass'";
    $run_query = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($run_query);
    if ($count == 1) {
        $row = mysqli_fetch_array($run_query);
        $_SESSION['cust-id'] = $row['customer_id'];
        $loginsucces = true;
        $login = true;
        $_SESSION['role']='customer';
//        echo "Welcome";
    } else {
//        echo "Incorrect Phone Number Or Passwrord";
        $login = true;
        $loginsucces = false;
        $label = "Incorrect Phone Number Or Passwrord";
    }
}
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
                <?php if ($loginsucces || $regsucces) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout-customer.php">Logout-Customer</a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="customer-info.php">Customer Info</a>
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
            <div class="col-xl-4">


                <!-- Start your project here-->
                <?php if ($regsucces && !$login) { ?>
                    <h1 class="mb-3 text-center"> Customer Created </h1>
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
                            <td><?php echo  substr($date, 0, 10); ?></td>
                        </tr>
                        </tbody>
                    </table>
                <div class="container-sm">
                    <button type="button" class="btn btn-primary btn-rounded" onclick=location.href="products.php">Go Shopping
                    </button>
                </div>
                <?php } else if (!$regsucces && !$login) {?>
                    <label class="mb-3 text-center"><?php echo $label ?> </label>
                    <div class="container-sm">
                        <button type="button" class="btn btn-primary btn-rounded" onclick=location.href="login-register.html">Go Back
                        </button>
                    </div>
                <?php } ?>



                <?php if ($loginsucces && $login) { ?>
                    <h1 class="mb-3 text-center"> Logged in Successful </h1>
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
                            <td><?php echo  substr($date, 0, 10); ?></td>
                        </tr>
                        </tbody>
                    </table>
                        <button type="button" class="btn btn-primary btn-rounded" onclick=location.href="products.php">Go Shopping
                        </button>
                        <button type="button" class="btn btn-secondary btn-rounded" onclick=location.href="customer-info.php">Billing History
                        </button>

                <?php } else if(!$loginsucces && $login) {?>
                <label class="mb-3 text-center"><?php echo $label ?> </label>
                <div class="container-sm">
                <button type="button" class="btn btn-primary btn-rounded" onclick=location.href="login-register.html">Go
                    Back
                </button>
                <button type="button" class="btn btn-secondary btn-rounded"
                        onclick=location.href="forget-pass.html">Forget Password
                </button>
            </div>
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
