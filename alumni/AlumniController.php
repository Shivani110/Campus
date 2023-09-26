<?php
    require("../config.php");

    class AlumniController{
        public $conn;
        public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);

            if($this->conn){

            }
        }

        public function collegeName(){
            $query = "Select * from college_name";
            $result = mysqli_query($this->conn,$query);
            $data = array();
            
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    array_push($data,$row);
                }
            }
            return $data;
        }

        public function college(){
           $user_id = $_SESSION['users']['id'][0];
           $query = "Select * from alumni INNER JOIN college_name ON alumni.school=college_name.id where alumni.user_id='$user_id' ";

           $result = mysqli_query($this->conn,$query);
           $data = array();

        //    if($result->num_rows>0){
             while($row=$result->fetch_assoc()){
                array_push($data,$row);
            //  }
           }
           return $data;
        }

        public function getAlumni($id){
            //print_r($id);

            $query = "Select * from alumni where user_id='$id' ";
            $result = mysqli_query($this->conn,$query);
            $data = array();

            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    array_push($data,$row);
                }
            }
            return $data;
        }
    }

    $dbConn = new AlumniController(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

    $clg = $dbConn->college();
   // print_r($clg);

?>