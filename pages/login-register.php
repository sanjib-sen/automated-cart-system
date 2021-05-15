<?php
$host = 'localhost';
$dbUsrname = 'root';
$dbPassword = '';
$dbname = 'project';
$conn = new mysqli($host, $dbUsrname, $dbPassword, $dbname);
$login = true;

$label = "";
session_start();


$showForm = true;


$admin = $_SESSION['admin-id'];
if (isset($_POST['cusreg'])) {
    if (mysqli_connect_error()) {
        die('Conner Error(' . mysqli_connect_errno() . ')' . mysqli_connect_errno());
    }
    $name = mysqli_real_escape_string($conn, $_POST['registerName']);
    $phone = mysqli_real_escape_string($conn, $_POST['registerNumber']);
    $pass = mysqli_real_escape_string($conn, $_POST['registerPassword']);

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
                $label = "Registration Successful";
                $regsucces = true;
                $login = false;
                $_SESSION['role'] = 'customer';
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
        $_SESSION['role'] = 'customer';
        $label = "Login Successful";


//        header("Location: products.php");


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
    <title>Customer Login</title>
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

                    <!-- Pills navs -->


                    <!-- Pills navs -->
                    <?php if (isset($_POST['fromlogin'])) { ?>

                        <div class="alert alert-success" role="alert">
                            <?php echo $_POST['fromlogin'] ?>
                        </div>

                    <?php } ?>


                    <?php if (isset($loginsucces) && isset($loginsucces) && $loginsucces && $login) { ?>

                        <form name="myform" method="post" action="products.php">
                            <input type="hidden" name="fromlogin" value="Login Successful">
                            <script language="JavaScript">document.myform.submit();</script>
                        </form>

                    <?php } ?>


                    <?php if (isset($loginsucces) && isset($loginsucces) && !$loginsucces && $login) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $label ?>
                        </div>
                        <?php
                    } ?>

                    <?php if (isset($regsucces) && isset($login) && !$regsucces && !$login) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $label ?>
                        </div>
                        <?php
                    } ?>


                    <?php if (isset($regsucces) && isset($login) && $regsucces && !$login) {
                        $showForm = false;
                        ?>

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
                                <td><?php echo substr($date, 0, 10); ?></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="container-sm">
                            <button type="button" class="btn btn-primary btn-rounded"
                                    onclick=location.href="products.php">Go Shopping
                            </button>
                        </div>
                    <?php }


                    if ($showForm) { ?>


                        <h1 class="mb-3 text-center">Shopping Cart</h1>

                        <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a
                                        class="nav-link active"
                                        id="tab-login"
                                        data-mdb-toggle="pill"
                                        href="#pills-login"
                                        role="tab"
                                        aria-controls="pills-login"
                                        aria-selected="true"
                                > Login</a
                                >
                            </li>
                            <li class="nav-item" role="presentation">
                                <a
                                        class="nav-link"
                                        id="tab-register"
                                        data-mdb-toggle="pill"
                                        href="#pills-register"
                                        role="tab"
                                        aria-controls="pills-register"
                                        aria-selected="false"
                                >Register</a
                                >
                            </li>
                        </ul>
                        <!-- Pills navs -->


                        <!-- Pills content -->
                        <div class="tab-content">
                            <div
                                    class="tab-pane fade show active"
                                    id="pills-login"
                                    role="tabpanel"
                                    aria-labelledby="tab-login"
                            >
                                <form method="post" action="login-register.php">

                                    <p class="text-center fw-bold "> Customer Login</p>

                                    <!-- Email input -->
                                    <div class="form-outline mb-4">
                                        <input type="Phone" name="loginNumber" class="form-control" required/>
                                        <label class="form-label" for="loginNumber">Phone Number</label>
                                    </div>

                                    <!-- Password input -->
                                    <div class="form-outline mb-4">
                                        <input type="password" name="loginPassword" class="form-control" required/>
                                        <label class="form-label" for="loginPassword">Password</label>
                                    </div>

                                    <div class="text-center mb-4">
                                        <!-- Simple link -->
                                        <a href="reset.php">Forgot password?</a>
                                    </div>
                                    <!-- Submit button -->
                                    <input type="submit" class="btn btn-primary btn-block mb-4" value="Sign in"
                                           name="cuslogin"/>
                                </form>
                            </div>
                            <div
                                    class="tab-pane fade"
                                    id="pills-register"
                                    role="tabpanel"
                                    aria-labelledby="tab-register"
                            >
                                <form action="login-register.php" method="POST">

                                    <p class="text-center fw-bold ">Register</p>

                                    <!-- Name input -->
                                    <div class="form-outline mb-4">
                                        <input type="text" name="registerName" class="form-control" required/>
                                        <label class="form-label" for="registerName">Name</label>
                                    </div>

                                    <!-- Phone input -->
                                    <div class="form-outline mb-4">
                                        <input type="Phone" name="registerNumber" class="form-control" required/>
                                        <label class="form-label" for="registerNumber">Phone Number</label>
                                    </div>

                                    <!-- Password input -->
                                    <div class="form-outline mb-4">
                                        <input type="password" name="registerPassword" class="form-control" required/>
                                        <label class="form-label" for="registerPassword">Password</label>
                                    </div>

                                    <!-- Repeat Password input -->
                                    <div class="form-outline mb-4">
                                        <input type="password" name="RepeatPassword" class="form-control"
                                               onChange="onChange()"
                                               required/>
                                        <label class="form-label" for="RepeatPassword">Repeat password</label>
                                    </div>

                                    <!-- Submit button -->
                                    <input type="submit" class="btn btn-primary btn-block mb-4" value="Sign Up"
                                           name="cusreg" required/>
                                </form>
                            </div>
                        </div>


                    <?php } ?>


                    <!-- Pills content -->


                    <!-- End your project here-->
                </div>
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