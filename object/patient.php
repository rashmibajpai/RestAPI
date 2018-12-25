<?php

class Patient{
 
    //database connection and table name
    private $conn;
    private $table_name = "patient";
 
    // object properties
    public $p_id;
    public $p_fname;
    public $p_mname;
    public $p_lname;
    public $p_emailid;
    public $p_phone;
    public $p_address;
    public $p_county;
    public $p_city;
    public $p_zipcode;
    public $p_country;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    // read Patient
    function read(){
 
    // select all query
    $query = "SELECT * FROM ".$this->table_name;
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
   }


   // used when filling up the update Patient form
function readOne(){
 
    // query to read single record
    $query = "SELECT * FROM ".$this->table_name." WHERE p_id = ? ";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    $stmt->bindParam(1, $this->p_id);
 
    // execute query
    $stmt->execute();

     // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    
    $this->p_fname= $row['p_fname'];
    $this->p_mname= $row['p_mname'];
    $this->p_lname= $row['p_lname'];
    $this->p_emailid= $row['p_phone'];
    $this->p_mname= $row['p_emailid'];
    $this->p_county= $row['p_county'];
    $this->p_address= $row['p_address'];
    $this->p_city= $row['p_city'];
    $this->p_zipcode= $row['p_zipcode'];
    $this->p_country= $row['p_country'];

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