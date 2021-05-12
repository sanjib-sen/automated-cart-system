<?php
     $host = 'localhost';
	$dbUsrname = 'root';
	$dbPassword = '';
	$dbname = 'project';
     session_start();
	$conn = new mysqli($host ,$dbUsrname ,$dbPassword ,$dbname  );
	if(isset($_POST['reset'])){
	if(mysqli_connect_error()){
		die('Conner Error('. mysqli_connect_errno().')'.mysqli_connect_errno());
	}
		$phone=mysqli_real_escape_string($conn,$_POST['phone']);
		$pass=mysqli_real_escape_string($conn,$_POST['Password']);


       $sql = "SELECT customer_id FROM customer WHERE phone_no = '$phone'" ;
       $check_query = mysqli_query($conn,$sql); 
       $count_no = mysqli_num_rows($check_query); 
       if($count_no == 1){ 
       $sql="UPDATE customer SET password='$pass' where phone_no='$phone'"; 
       $run_query=mysqli_query($conn,$sql); 
       if($run_query){ 
       $sql_new="SELECT * FROM customer WHERE phone_no='$phone' AND password='$pass'"; 
       $run_query_new=mysqli_query($conn,$sql_new); 
       $count_new=mysqli_num_rows($run_query_new); 
       if($count_new==1){ 
       $row_new=mysqli_fetch_array($run_query_new); 
       $_SESSION['uid']=$row_new['customer_id']; 
       echo "Successfully Password Changed"; 
       } 
       } 
    }
}
?>