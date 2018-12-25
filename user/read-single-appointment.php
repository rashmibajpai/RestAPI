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

$appointment = new Appointment($db);
 
$appointment->a_id = isset($_GET['a_id']) ? $_GET['a_id'] : die();

$appointment->readOne();
 
//create array
$appointment_arr = array(
    
    "a_id" => $appointment->$a_id,
    "p_adate" => $appointment->$p_adate,
    "p_atime" => $appointment->$p_atime,
    "p_speciality" => $appointment->$p_speciality,
    "p_id" => $appointment->$p_id,
    "p_fname" => $appointment->$p_fname,
    "p_lname" => $appointment->$p_lname,
    "p_emailid" => $appointment->$p_emailid,
    "p_phone" => $appointment->$p_phone
    
 );
 
//print_r($appointment);

print_r(json_encode($appointment));

?>


