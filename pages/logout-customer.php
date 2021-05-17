<?php
session_start();
$_SESSION['role'] = 'admin';
$admin = $_SESSION['admin-id'];

session_destroy();
session_start();
$_SESSION['role'] = 'admin';
$_SESSION['admin-id'] = $admin;
$_SESSION['label'] = "Logout Successful";

header('Location:index.php');
exit();
?>