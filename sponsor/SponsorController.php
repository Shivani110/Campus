<?php
    require('../config.php');

    class SponsorController{
        public $conn;
        public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);

            if($this->conn){
             
            }
        } 

        public function getSponsor($id){
            $query = "Select * from sponsor where user_id='$id'";
            $result = mysqli_query($this->conn,$query);
            $data = array();

            if($result == true){
                while($row=$result->fetch_assoc()){
                    //print_r($row);
                    array_push($data,$row);
                }
            }
            return $data;
        }
       
    }

    $dbConn = new SponsorController(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

?>