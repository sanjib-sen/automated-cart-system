<?php
$host = 'localhost';
$dbUsrname = 'root';
$dbPassword = '';
$dbname = 'project';
session_start();
$conn = new mysqli($host, $dbUsrname, $dbPassword, $dbname);
$loginsucces = true;
$label = "";

if (isset($_POST['Username'])) {
    $username = mysqli_real_escape_string($conn, $_POST['Username']);
    $pass = mysqli_real_escape_string($conn, $_POST['Password']);
    $sql = "SELECT * FROM admin WHERE user_id='$username' AND password='$pass'";
    $run_query = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($run_query);
    if ($count == 1) {
        $row = mysqli_fetch_array($run_query);
        $_SESSION['role'] = 'admin';
        $_SESSION['admin-id'] = $username;
        $loginsucces = true;
        $label = "Admin Login Success";
//        echo "Welcome";
    } else {
//        echo "Incorrect Phone Number Or Passwrord";
        $loginsucces = false;
        $label = "Incorrect Username Or Password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <title>Admin Dashboard</title>
    <!-- MDB icon -->
    <link rel="icon" href="elements/img/bracu.ico" type="image/x-icon"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css"/>
    <!-- Google Fonts Roboto -->
    <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="elements/css/mdb.min.css"/>
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

                <?php if (isset($_SESSION['admin-id'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="login-register.php">Customer-Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout-admin.php">Logout-Admin</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../index.html">Home</a>
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


                    <?php if (isset($_POST['Username']) && !$loginsucces) { ?>
                        <div class="alert alert-danger" role="alert">
                            Incorrect Username/Password <br>
                            Contact Administrator!
                        </div>
                    <?php } ?>

                    <?php if (!isset($_SESSION['admin-id']) || (isset($_POST['Username']) && !$loginsucces)) {
                        if (isset($_SESSION['label'])) { ?>
                            <div class="alert alert-success" role="alert"><?php echo $_SESSION['label'] ?></div>
                        <?php }
                    ;
                        unset($_SESSION['label']); ?>

                        <h1 class="mb-3 text-center">Admin Login</h1>
                        <form method="post" action="index.php">
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="text" name="Username" class="form-control" required/>
                                <label class="form-label">Username </label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" name="Password" class="form-control" required/>
                                <label class="form-label">Password</label>
                            </div>


                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                        </form>


                    <?php } ?>

                    <!-- Start your project here-->
                    <?php if ($loginsucces && isset($_POST['Username'])) { ?>
                        <div class="alert alert-success" role="alert">
                            Login Successful
                        </div>
                    <?php } ?>

                    <?php if (isset($_SESSION['admin-id'])) {
                        if (isset($_SESSION['label'])) { ?>
                            <div class="alert alert-success" role="alert"><?php echo $_SESSION['label'] ?></div>
                        <?php }
                    ;
                        unset($_SESSION['label']); ?>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Customer Login/Signup</h5>
                                        <p class="card-text">
                                            Create a New Customer or login to an Existing Customer.
                                        </p>
                                        <a href="login-register.php" class="btn btn-primary">Customer</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Products Management</h5>
                                        <p class="card-text">
                                            Add Products to Cart, Edit Product Info, Delete Product.
                                        </p>
                                        <a href="products.php" class="btn btn-primary">Product</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                </div>


                <!-- End your project here-->
            </div>
        </div>
    </div>
</div>

<!-- MDB -->
<script type="text/javascript" src="elements/js/mdb.min.js"></script>
<!-- Custom scripts -->
<script type="text/javascript"></script>
</body>
</html>
