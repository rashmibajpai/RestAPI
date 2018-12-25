<?php

class Employee{
 
    //database connection and table name
    private $conn;
    private $table_name = "employee";
 
    // object properties
    public $emp_id;
    public $emp_fname;
    public $emp_lname;
    public $emp_email;
    public $emp_phone;
    public $dept_id;
    public $emp_joindt;
    public $emp_job;
    public $emp_desg;
    public $emp_address1;
    public $emp_address2;
    public $emp_county;
    public $emp_city;
    public $emp_state;
    public $emp_zip;
    public $emp_country;
    public $dept_name;
    public $B_ID;
 
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    // read Employee
    function read(){
 
    // select all query
    $query = "SELECT * FROM ".$this->table_name;
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
   }


   // used when filling up the update Employee form
function readOne(){
 
    // query to read single record
    $query = "SELECT * FROM ".$this->table_name." WHERE emp_id = ? ";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    $stmt->bindParam(1, $this->emp_id);
 
    // execute query
    $stmt->execute();

     // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    
    $this->emp_fname= $row['emp_fname'];
    $this->emp_lname= $row['emp_lname'];
    $this->emp_email= $row['emp_email'];
    $this->emp_phone= $row['emp_phone'];
    $this->dept_id= $row['dept_id'];
    $this->emp_joindt= $row['emp_joindt'];
    $this->emp_job= $row['emp_job'];
    $this->emp_desg= $row['emp_desg'];
    $this->emp_address1= $row['emp_address1'];
    $this->emp_address2= $row['emp_address2'];

    $this->emp_county= $row['emp_county'];
    $this->emp_city= $row['emp_city'];
    $this->emp_state= $row['emp_state'];
    $this->emp_zip= $row['emp_zip'];
    $this->emp_country= $row['emp_country'];
    $this->dept_name= $row['dept_name'];
    $this->B_ID= $row['B_ID'];
    
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