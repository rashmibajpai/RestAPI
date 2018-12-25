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

// echo "connected successfully.";   
}
	$response = array();
	
	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){
			
			case 'login-with-google':
				if(isTheseParametersAvailable(array('p_fname','p_lname','p_emailid'))){
					 
					$p_fname = $_POST['p_fname'];
					$p_lname = $_POST['p_lname']; 
					$p_emailid = $_POST['p_emailid']; 
					
					
					
					$stmt = $connect->prepare("SELECT p_id, p_fname, p_lname, p_emailid,p_phone FROM patient WHERE p_emailid = ? OR p_fname = ?");
					$stmt->bind_param("ss", $p_emailid, $p_fname);
					
					$result = $stmt->execute();
					$user   = $stmt->fetch(PDO::FETCH_ASSOC);
					print_r($user);
					//$stmt->execute();
					//$stmt->fetch();
					$stmt->store_result();
					$user = array(
						'p_id'=>$p_id, 
						'p_fname'=>$p_fname, 
						'p_lname'=>$p_lname,
						'p_emailid'=>$p_emailid,
						'p_status'=> '1'
					);
			
					if($stmt->num_rows > 0){
					$stmt->bind_result($p_id, $p_fname, $p_lname, $p_emailid,$p_phone);
					$stmt->fetch();
						
						$user = array(
							'p_id'=>$p_id, 
							'p_fname'=>$p_fname, 
							'p_lname'=>$p_lname,
							'p_emailid'=>$p_emailid,
							'p_phone'=>$p_phone
						);
					
						$response['error'] = true;
						$response['message'] = 'User already registered';
						$response['user'] = $user; 
						print_r($user);
						$stmt->close();
					}else{
						$stmt = $connect->prepare("INSERT INTO patient (p_fname, p_lname,p_emailid, p_status) VALUES ( ?, ?, ?,'1')");
						$stmt->bind_param("sss", $p_fname, $p_lname, $p_emailid);

						if($stmt->execute()){
							$stmt = $connect->prepare("SELECT * FROM patient WHERE p_emailid = ?"); 
							$stmt->bind_param("s",$p_emailid);
							$stmt->execute();
							$stmt->bind_result( $p_id, $p_fname, $p_lname, $p_emailid);
							$stmt->fetch();
							//print_r($stmt);
							$user = array(
								'p_id'=>$p_id, 
								'p_fname'=>$p_fname, 
								'p_lname'=>$p_lname,
								'p_emailid'=>$p_emailid,
								'p_status'=> '1'
							);
							//print_r($user);
							$stmt->close();
							
							$response['error'] = false; 
							$response['message'] = 'User registered successfully'; 
							$response['user'] = $user; 
						}
					}
					
				}else{
					$response['error'] = true; 
					$response['message'] = 'required parameters are not available'; 
				}
				
			break; 
			
			case 'login':
				
				if(isTheseParametersAvailable(array('p_emailid', 'password'))){
					
					$p_emailid = $_POST['p_emailid'];
					$password = md5($_POST['password']); 
					
					$stmt = $connect->prepare("SELECT p_id, p_fname, p_lname, p_emailid,p_phone FROM patient WHERE p_emailid = ? AND password = ?");
					$stmt->bind_param("ss", $p_emailid, $password);
					
					$stmt->execute();
					
					$stmt->store_result();
					
					//print_r($stmt->num_rows);
					
					if($stmt->num_rows > 0){
						
						$stmt->bind_result($p_id, $p_fname, $p_lname, $p_emailid,$p_phone);
						$stmt->fetch();
						
						$user = array(
							'p_id'=>$p_id, 
							'p_fname'=>$p_fname, 
							'p_lname'=>$p_lname,
							'p_emailid'=>$p_emailid,
							'p_phone'=>$p_phone
						);
						//print_r($user);
						
						$response['error'] = false; 
						$response['message'] = 'Login successfull'; 
						$response['user'] = $user; 
					}else{
						$response['error'] = false; 
						$response['message'] = 'Invalid username or password';
					}
				}
			break; 
			
			default: 
				$response['error'] = true; 
				$response['message'] = 'Invalid Operation Called';
		}
		
	}else{
		$response['error'] = true; 
		$response['message'] = 'Invalid API Call';
	}
	
	echo json_encode($response);
	
	function isTheseParametersAvailable($params){
		
		foreach($params as $param){
			if(!isset($_POST[$param])){
				return false; 
			}
		}
		return true; 
	}


	?>