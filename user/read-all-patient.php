<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once "../config/database.php";
include_once "../object/patient.php";
 
$database = new Database();
$db = $database->getConnection();
 
$patient= new Patient($db);
 
$stmt = $patient->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $patients_arr=array();
    $patients_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $patient_item=array(
            "p_id" => $p_id,
            "p_fname" => $p_fname,
            "p_mname" => $p_mname,
            "p_lname" => $p_lname,
            "p_address" => $p_address,
        
            "p_city" => $p_city,
            "p_zipcode" => $p_zipcode,
            "p_country" => $p_country

        );
 
        array_push($patients_arr["records"], $patient_item);
    }
 
    echo json_encode($patients_arr);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}

?>