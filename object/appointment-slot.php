<?php

class Appointmentslot{
 
    //database connection and table name
    private $conn;
    private $table_name = "AppoitmentSlot";
 
    // object properties
    public $Slot_ID;
    public $Slot_No;
    public $Slot_Date;
    public $Slot_Time;
    public $Slot_Status;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    // read Appointment
    function read(){
 
    // select all query
    $query = "SELECT * FROM ".$this->table_name." WHERE Slot_No='1'";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
   }



}