<?php

class Appointmentpatientid{
 
    //database connection and table name
    private $conn;
    private $table_name = "appointment";
 
    // object properties
    public $a_id;
    public $p_adate;
    public $p_atime;
    public $p_speciality;
    public $p_firstname;
    public $p_lastname;
    public $p_emailid;
    public $p_phone;
    

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read Appointment
    function read(){
 
    // select all query
    //$query = "SELECT * FROM appointment";
 
    $query = "SELECT a.a_id,p.p_id,p.p_fname,p.p_lname,p.p_emailid,p.p_phone,a.p_adate,a.p_atime,a.p_speciality FROM appointment a inner join patient p on p.p_id=a.p_id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
    
   }

   // used when filling up the update Appointment form
function readOne(){
 
    // query to read single record
    //$query = "SELECT * FROM ".$this->table_name." WHERE a_id = ? ";
    
   $query = "SELECT a.a_id,p.p_id,p.p_fname,p.p_lname,p.p_emailid,p.p_phone,a.p_adate,a.p_atime,a.p_speciality FROM appointment a inner join patient p on p.p_id=a.p_id WHERE a.a_id = ? ";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    $stmt->bindParam(1, $this->a_id);
 
    // execute query
    $stmt->execute();

     // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //print_r($row);
    
    $this->a_id = $row['a_id'];
    $this->p_adate = $row['p_adate'];
    $this->p_atime = $row['p_atime'];
    $this->p_speciality = $row['p_speciality'];
    $this->p_id = $row['p_id'];
    $this->p_fname = $row['p_fname'];
    $this->p_lname = $row['p_lname'];
    $this->p_emailid = $row['p_emailid'];
    $this->p_phone = $row['p_phone'];
    
   
   }

   // create Patient
   function create(){
 
    // query to insert record
    $query = "INSERT INTO ".$this->table_name."(p_fname, p_mname,p_lname,p_emailid,p_phone,p_address,p_county,p_city,p_zipcode,p_country) VALUES('$p_fname','$p_mname','$p_lname','$p_emailid','$p_phone','$p_address','$p_county','$p_city','$p_zipcode','$p_country')";

 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->p_fname=htmlspecialchars(strip_tags($this->fname));
    $this->p_mname=htmlspecialchars(strip_tags($this->mname));
    $this->p_lname=htmlspecialchars(strip_tags($this->lname));
    $this->p_emailid=htmlspecialchars(strip_tags($this->emailid));

    $this->p_phone=htmlspecialchars(strip_tags($this->p_phone));
    $this->p_address=htmlspecialchars(strip_tags($this->p_address));
    $this->p_county=htmlspecialchars(strip_tags($this->county));
    $this->p_city=htmlspecialchars(strip_tags($this->p_city));
    $this->p_zipcode=htmlspecialchars(strip_tags($this->zipcode));
    $this->p_country=htmlspecialchars(strip_tags($this->country));
 
    // bind values
    $stmt->bindParam(":p_fname", $this->p_fname);
    $stmt->bindParam(":p_mname", $this->p_mname);
    $stmt->bindParam(":p_lname", $this->p_lname);
    $stmt->bindParam(":p_emailid", $this->p_emailid);
    $stmt->bindParam(":p_phone", $this->p_phone);
    $stmt->bindParam(":p_address", $this->p_address);
    $stmt->bindParam(":p_county", $this->p_county);
    $stmt->bindParam(":p_city", $this->p_city);
    $stmt->bindParam(":p_zipcode", $this->p_zipcode);
    $stmt->bindParam(":p_country", $this->p_country);
    
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
   }

}