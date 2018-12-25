<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once "../config/database.php";
include_once "../object/emp.php";
 
$database = new Database();
$db = $database->getConnection();
 
$employee= new Employee($db);
 
$stmt = $employee->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // employee array
    $employee_arr=array();
    $employee_arr["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);
 
        $employee_item=array(
            "emp_id" => $emp_id,
            "emp_fname" => $emp_fname,
            "emp_lname" => $emp_lname,
            "emp_email" => $emp_email,
            "emp_phone" => $emp_phone,
            "dept_id" => $dept_id,
            "emp_joindt" => $emp_joindt,
            "emp_job" => $emp_job,
            "emp_desg" => $emp_desg,
            "emp_address1" => $emp_address1,
            "emp_address2" => $emp_address2,
            "emp_county" => $emp_county,
            "emp_city" => $emp_city,
            "emp_state" => $emp_state,
            "emp_zip" => $emp_zip,
            "emp_country" => $emp_country,
            "dept_name" => $dept_name,
            "B_ID" => $B_ID



        );


        array_push($employee_arr["records"], $employee_item);
    }
 
    echo json_encode($employee_arr);
}
 
else{
    echo json_encode(
        array("message" => "No employee found.")
    );
}

?>