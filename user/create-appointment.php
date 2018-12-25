<?php

$servername = "localhost";
$username = "test";
$password = "123#";

$connect = new mysqli($servername, $username, $password);

mysqli_select_db($connect, "testdb");

if(!$connect){
 //echo "Error: Unable to connect to MySQL.";

}

else{

//echo "connected successfully."; 
}
$actionName = (isset($_POST['actionName'])) ? $_POST['actionName'] : '';
if($actionName == 'insertPost') {

$p_adate = $_POST['p_adate'];

$p_atime= $_POST['p_atime'];
$p_speciality = $_POST['p_speciality'];
$p_id = $_POST['p_id'];


$reg_query = mysqli_query($connect, "INSERT into appointment (p_adate, p_atime, p_speciality,p_id) VALUES('$p_adate','$p_atime','$p_speciality','$p_id')");

$reg_query_update = mysqli_query($connect, "UPDATE AppoitmentSlot set Slot_No='0', Slot_Status='Fixed' WHERE Slot_Date='$p_adate' AND Slot_Time='$p_atime'");

    if(isset($reg_query) AND isset($reg_query_update)) {
 
     $resultData = array('status' => true, 'message' => 'Appointment Details Added Successfully');

     } else {

      $resultData = array('status' => false, 'message' => 'There is some error occurred.');

    }

echo json_encode($resultData);

}



?>