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

$emp_fname= $_POST['emp_fname'];
$emp_lname= $_POST['emp_lname'];
$emp_email= $_POST['emp_email'];
$emp_phone = $_POST['emp_phone'];
$dept_id = $_POST['dept_id'];
$emp_name= $_POST['emp_name'];
$emp_phone = $_POST['emp_phone'];
$emp_joindt = $_POST['emp_joindt'];
$emp_job= $_POST['emp_job'];
$emp_desg = $_POST['emp_desg'];
$emp_address1 = $_POST['emp_address1'];
$emp_address2 = $_POST['emp_address2'];
$emp_county = $_POST['emp_county'];
$emp_city = $_POST['emp_city'];
$emp_state= $_POST['emp_state'];
$emp_zip = $_POST['emp_zip'];
$emp_country = $_POST['emp_country'];
$dept_name= $_POST['dept_name'];
$B_ID = $_POST['B_ID'];




$reg_query = mysqli_query($connect, "INSERT into employee (emp_fname, emp_lname,emp_email, emp_phone,emp_joindt,emp_job,emp_desg,emp_address1,emp_address2,emp_county,emp_city,emp_state,emp_zip,emp_country,dept_name,B_ID) VALUES('$emp_fname','$emp_lname','$emp_email','$emp_phone','$emp_joindt','$emp_job','$emp_desg','$emp_address1','$emp_address2','$emp_county',
'$emp_city','$emp_state','$emp_zip','$emp_country','$dept_name','$B_ID') ");



    if(isset($reg_query)) {
 
     $resultData = array('status' => true, 'message' => 'Emp Details Added Successfully');

     } else {

      $resultData = array('status' => false, 'message' => 'There is some error occurred.');

    }

echo json_encode($resultData);

}



?>