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

	$username = mysqli_real_escape_string($connect, $_POST['forgetemail']);
        $Newpassword = substr(mt_rand(),0,15);
        $DbPassword = md5($Newpassword);
	$sql = "UPDATE patient set password='$DbPassword' WHERE p_emailid= '$username'";
	$res = mysqli_query($connect, $sql);
	if($res) {

           //$r = mysqli_fetch_array($res);
           
               $message = "Your Temporary Password is ".$Newpassword;
               $to = $username;
               $subject = "Your Recovered Password";

               // Always set content-type when sending HTML email
               $headers = "MIME-Version: 1.0" . "\r\n";
               $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

               // More headers
               $headers .= 'From: <no-reply@kaizenfamilydental.com>' . "\r\n";           

               if(mail($to, $subject, $message, $headers)) {

	       
                $resultData = array('status' => true, 'message' => 'Your Password has been sent to your email id');

               } else {

	       
                 $resultData = array('status' => false, 'message' => 'Failed to Recover your password, try again');

               }
               
               echo json_encode($resultData);
        }
  }

?>
