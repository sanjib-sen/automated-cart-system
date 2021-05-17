<?php
session_start();
session_destroy();
header('Location:index.php');
session_start();
$_SESSION['label'] = "Logout Successful";
?>
