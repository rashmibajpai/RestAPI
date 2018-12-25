<?php

$servername = "localhost";
$username = "test";
$password = "@123#";

$connect = new mysqli($servername, $username, $password);

mysqli_select_db($connect, "testdb");

if(!$connect){
 echo "Error: Unable to connect to MySQL.";

}

else{

 //echo "connected successfully.";   
}

$actionName = (isset($_POST['actionName'])) ? $_POST['actionName'] : '';

if($actionName == 'insertPost') {

$npassword = $_POST['npassword'];
$cpassword = $_POST['cpassword'];
$email = $_POST['useremail'];

	if($npassword == $cpassword) {
	
	$cpassword = md5($_POST['cpassword']);
	$reg_query = mysqli_query($connect, "UPDATE patient SET password='$cpassword' where p_emailid= '$email'");
	
	// Mysql_num_row is counting table row
	//$count=mysqli_num_rows($reg_query);
	
		if($reg_query) {
		  
		$resultData = array('status' => true, 'message' => 'Password Changed Successfully');
		
		} else {
		
		$resultData = array('status' => true, 'message' => 'Nothing Changed. Server Error');
		
		}
	
	} else {
	
	$resultData = array('status' => true, 'message' => 'Passwords doesnt match. Please try again');
	
	}


	echo json_encode($resultData);

               
        }

?>
