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

// for code debuging  print_r($_POST);


$actionName = (isset($_POST['actionName'])) ? $_POST['actionName'] :'';
if($actionName == 'insertPost') {

$appointment_id = $_POST['a_id'];
$a_status = $_POST['a_status'];
$p_id_ = $_POST['p_id_'];
$emp_id = $_POST['emp_id'];
$notes = $_POST['notes'];

 $reg_query =mysqli_query($connect, "UPDATE appointment SET a_status='$a_status',p_id='$p_id_',emp_id='$emp_id',notes='$notes' WHERE a_id='$appointment_id'");

//echo "UPDATE appointment SET a_status='$a_status',p_id='$p_id_' WHERE a_id='$appointment_id'";


    if(isset($reg_query)) {
 
     $resultData = array('status' => true, 'message' => 'Appointment Details Updated Successfully');

     } else {

      $resultData = array('status' => false, 'message' => 'There is some error occurred.');

    }

echo json_encode($resultData);

}



?>