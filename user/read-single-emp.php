  <?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
include_once "../config/database.php";
include_once "../object/emp.php";
 
$database = new Database();
$db = $database->getConnection();

$employee = new Employee($db);
 
$employee->emp_id = isset($_GET['emp_id']) ? $_GET['emp_id'] : die();

$employee->readOne();
 
// create array
$employee_arr = array(
    "emp_id" =>  $employee->emp_id,
    "emp_fname" => $employee->emp_fname,
    "emp_lname" => $employee->emp_lname,
    "emp_emailid" => $employee->emp_emailid,
    "emp_phone" => $employee->emp_phone,
    "dept_id" => $employee->dept_id,
    "emp_joindt" => $employee->emp_joindt,
    "emp_job" => $employee->emp_job,
    "emp_desg" => $employee->emp_desg,
    "emp_address1" => $employee->emp_address1,
    "emp_address2" => $employee->emp_address2,
    "emp_county" => $employee->emp_county,
    "emp_city" => $employee->emp_city,
    "emp_state" => $employee->emp_state,
   "emp_zip" => $employee->emp_zip,
    "emp_country" => $employee->emp_country,
    "dept_name" => $employee->dept_name,
    "B_ID " => $employee->B_ID 
 );

print_r(json_encode($employee_arr));

?>


