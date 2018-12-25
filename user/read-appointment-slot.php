<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once "../config/database.php";
include_once "../object/appointment-slot.php";
 
$database = new Database();
$db = $database->getConnection();
 
$appointmentslot= new Appointmentslot($db);
 
$stmt = $appointmentslot->read();
//print_r($stmt);

$num = $stmt->rowCount();

//print_r($num);
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $appointmentslot_arr=array();
    $appointmentslot_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        
        //print_r($row);
 
 
    $appointmentslot_item=array(

    "Slot_ID" => $Slot_ID,
    "Slot_No" => $Slot_No,
    "Slot_Date" => $Slot_Date,
    "Slot_Time" => $Slot_Time,
    "Slot_Status" => $Slot_Status

     );
 
        array_push($appointmentslot_arr["records"], $appointmentslot_item);
    }
 
    echo json_encode($appointmentslot_arr);
}
 
else{
    echo json_encode(
        array("message" => "No appointmentslot_item found.")
    );
}

?>