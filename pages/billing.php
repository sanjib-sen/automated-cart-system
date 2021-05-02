
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
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="productlist.html">Products</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#" tabindex="-1" aria-disabled="false"
          >LogOut</a
          >
        </li>
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->





<div class="mask d-flex align-items-center h-100">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-4">


        <!-- Start your project here-->

        <h1 class="mb-3 text-center"> Billing Info </h1>
        <table class="table">
          <tbody>
          <tr>
            <td>Customer Name</td>
            <td> Sanjib</td>
<!--            <td><?php echo $name ?></td>-->
          </tr>
          <tr>
            <td>Total Bill</td>
            <td>122.3</td>
<!--            <td><?php echo $date ?></td>-->
          </tr>
          <tr>
            <td>
              Payment Method
            </td>
            <td>
              <div class="dropdown">
                <button
                        class="btn btn-primary dropdown-toggle"
                        type="button"
                        id="dropdownMenuButton"
                        data-mdb-toggle="dropdown"
                        aria-expanded="false"
                >
                  Select
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <li><a class="dropdown-item" href="#">Card</a></li>
                  <li><a class="dropdown-item" href="#">Cash</a></li>
                  <li><a class="dropdown-item" href="#">Bkash</a></li>
                </ul>
              </div>
            </td>
          </tr>
          </tbody>
        </table>
        <!-- End your project here-->
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