<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
include_once "../config/database.php";
include_once "../object/appointment.php";

 
$database = new Database();
$db = $database->getConnection();
 
$appointment= new Appointment($db);

$appointment->p_id = isset($_GET['p_id']) ? $_GET['p_id'] : die();

$stmt = $appointment->readOneByPatient();

$num = $stmt->rowCount();

//print_r($num);
 
// check if more than 0 record found
if($num>0) {
 
    // appointment array
    $appointment_arr=array();
    $appointment_arr["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);

        //print_r($row);
 
        $appointment_item=array(
            "a_id" => $a_id,
            "p_adate" => $p_adate,
            "p_atime" => $p_atime,
            "p_speciality" => $p_speciality,
            "p_status" => $a_status,
            "p_id" => $p_id,
            "p_fname" => $p_fname,
            "p_lname" => $p_lname,
            "p_emailid" => $p_emailid,
            "p_phone" => $p_phone
        );

        array_push($appointment_arr["records"], $appointment_item);
        //print_r($appointment_item);
    }
 
    echo json_encode($appointment_arr);

} else {

    
    echo json_encode(
        array("message" => "No appointment found.")
    );
    
}


?>
