<?php
$success = false;

if (isset($_POST['reset'])) {
    $host = 'localhost';
    $dbUsrname = 'root';
    $dbPassword = '';
    $dbname = 'project';

    $conn = new mysqli($host, $dbUsrname, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
        die('Conner Error(' . mysqli_connect_errno() . ')' . mysqli_connect_errno());
    }

    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $pass = mysqli_real_escape_string($conn, $_POST['Password']);

    $sql = "SELECT customer_id FROM customer WHERE phone_no = '$phone'";
    $check_query = mysqli_query($conn, $sql);
    $count_no = mysqli_num_rows($check_query);
    if ($count_no == 1) {
        $sql = "UPDATE customer SET password='$pass' where phone_no='$phone'";
        $run_query = mysqli_query($conn, $sql);
        if ($run_query) {
            $sql_new = "SELECT * FROM customer WHERE phone_no='$phone' AND password='$pass'";
            $run_query_new = mysqli_query($conn, $sql_new);
            $count_new = mysqli_num_rows($run_query_new);
            if ($count_new == 1) {
                $row_new = mysqli_fetch_array($run_query_new);
                session_start();
                $_SESSION['uid'] = $row_new['customer_id'];
                $success = true;
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <title>Page Name</title>
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


<script>
    function onChange() {
        const password = document.querySelector('input[name=registerPassword]');
        const confirm = document.querySelector('input[name=RepeatPassword]');
        if (confirm.value === password.value) {
            confirm.setCustomValidity('');
        } else {
            confirm.setCustomValidity('Passwords do not match');
        }
    }
</script>

<div class="border border-0 p-5">
    <div class="d-flex align-items-center h-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4">


                    <!-- Start your project here-->

                    <?php if ($success) { ?>

                        <form name="myform" method="post" action="login-register.php">
                            <input type="hidden" name="fromlogin" value="Password Reset Successful">
                            <script language="JavaScript">document.myform.submit();</script>
                        </form>

                    <?php } ?>


                    <h1 class="mb-3 text-center">Reset Password</h1>
                    <form method="POST" action="reset.php">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="Phone" name="phone" class="form-control" required/>
                            <label class="form-label" for="phone">Phone Number</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" name="Password" class="form-control" required/>
                            <label class="form-label" for="Password">Password</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" name="ConfirmPass" class="form-control" onChange="onChange()"
                                   required/>
                            <label class="form-label" for="ConfirmPass">Confirm Password</label>
                        </div>

                        <!-- Submit button -->
                        <input type="submit" class="btn btn-primary btn-block mb-4" value="Reset Password" name="reset"
                               required/>
                    </form>


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
