<?php

$servername = "localhost";
$username = "test";
$password = "123#";

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


$p_fname = $_POST['p_fname'];
$p_mname= $_POST['p_mname'];
$p_lname = $_POST['p_lname'];
$p_emailid = $_POST['p_emailid'];
$p_phone = $_POST['p_phone'];
$p_address = $_POST['p_address'];
$p_county = $_POST['p_county'];
$p_city = $_POST['p_city'];
$p_zipcode = $_POST['p_zipcode'];
$p_country = $_POST['p_country'];

$reg_query = mysqli_query($connect, "INSERT into patient (p_fname, p_mname,p_lname,p_emailid,p_phone,p_address,p_county,p_city,p_zipcode,p_country) VALUES('$p_fname','$p_mname','$p_lname','$p_emailid','$p_phone','$p_address','$p_county','$p_city','$p_zipcode','$p_country') ");
        



    if(isset($reg_query)) {
 
     $resultData = array('status' => true, 'message' => 'Patient Details Added Successfully');

     } else {

      $resultData = array('status' => false, 'message' => 'There is some error occurred.');

    }

echo json_encode($resultData);

}



?>