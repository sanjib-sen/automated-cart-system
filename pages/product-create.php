<?php
session_start();
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
                <li class="nav-item">
                    <a class="nav-link" href="products.php">Products</a>
                </li>
                <?php if($_SESSION['role']=='admin'){ ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="login-register.html">Customer Registration</a>
                    </li>
                <?php } else{ ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="customer-info.php">Customer Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout-customer.php">Logout-Customer</a>
                    </li>
                <?php }  ?>

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


        <form action="product-registration.php" method="POST" enctype="multipart/form-data" >

          <p class="text-center fw-bold ">Register Product</p>

<!--          Image Input-->
          <div class="input-group mb-3">
            <label class="input-group-text" for="image">Image</label>
            <input type="file" id="image" class="form-control" name="image" aria-describedby="inputGroupFileAddon03"
                   aria-label="Upload" required/>
          </div>

          <!-- Name input -->
          <div class="form-outline mb-4">
            <input type="text" name="title" class="form-control" required />
            <label class="form-label" for="title">Name</label>
          </div>

          <!-- Phone input -->
          <div class="form-outline mb-4">
            <input type="text" name="description" class="form-control" required height="" />
            <label class="form-label" for="description">Description</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-4">
            <input type="number" name="price" class="form-control" required/>
            <label class="form-label" for="price">Price</label>
          </div>

          <div class="form-outline mb-4">
            <input type="text" name="category" class="form-control" required height="" />
            <label class="form-label" for="category">Category</label>
          </div>

          <div class="form-outline mb-4">
            <input type="number" name="stock" class="form-control" required/>
            <label class="form-label" for="price">Stock</label>
          </div>

          <!-- Submit button -->
          <input type="hidden" name="action" value="registered">
          <input type="submit" class="btn btn-primary btn-block mb-4" />
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