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
$p_adate_ = $_POST['p_adate_'];
$p_atime= $_POST['p_atime'];
$p_speciality = $_POST['p_speciality'];
//$p_id_ = $_POST['p_id_'];

 $reg_query =mysqli_query($connect, "UPDATE appointment SET p_adate='$p_adate_', p_atime='$p_atime', p_speciality='$p_speciality' WHERE a_id='$appointment_id'");

echo "UPDATE appointment SET p_adate='$p_adate_', p_atime='$p_atime', p_speciality='$p_speciality', p_id='$pid' WHERE a_id='$appointment_id'";


    if(isset($reg_query)) {
 
     $resultData = array('status' => true, 'message' => 'Appointment Details Updated Successfully');

     } else {

      $resultData = array('status' => false, 'message' => 'There is some error occurred.');

    }

echo json_encode($resultData);

}



?>