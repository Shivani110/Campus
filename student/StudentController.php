<?php 
    require("../config.php");

    class StudentController{
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

        public function getStudent($id){
            //print_r($id);
            $query = "Select * from student where user_id='$id'";
            $result = mysqli_query($this->conn,$query);
            $data = array();

            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){

                    array_push($data,$row);
                    //print_r($data);
                }
            }
            return $data;
        }
    }

    $dbConn = new StudentController(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);
?>