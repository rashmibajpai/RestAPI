<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
include_once "../config/database.php";
include_once "../object/patient.php";
 
$database = new Database();
$db = $database->getConnection();

$patient = new Patient($db);
 
$patient->p_id = isset($_GET['p_id']) ? $_GET['p_id'] : die();

$patient->readOne();
 
// create array
$patient_arr = array(
    "p_id" =>  $patient->p_id,
    "p_fname" => $patient->p_fname,
    "p_mname" => $patient->p_mname,
    "p_lname" => $patient->p_lname,
    "p_emailid" => $patient->p_emailid,
    "p_phone" => $patient->p_phone,
    "p_address" => $patient->p_address,
    "p_city" => $patient->p_city,
    "p_zipcode" => $patient->p_zipcode,
    "p_address" => $patient->p_address,
    "p_country" => $patient->p_country
 );

print_r(json_encode($patient_arr));

?>