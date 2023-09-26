<?php
    require('../config.php');

    class StaffController{
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

        public function getStaff($id){
            //print_r($id);
            $query = "Select * from staff where user_id='$id'";
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

        public function getCollege($data){
            $user_id = $data[0];
            $user_type = $data[1];
           
            $query = "Select * from users 
                    INNER JOIN staff ON users.id=staff.user_id
                    INNER JOIN college_name ON college_name.id=staff.college_name where users.user_type='$user_type' AND staff.user_id='$user_id'";

            $result = mysqli_query($this->conn,$query);
            $data = array();

            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    array_push($data,$row);
                }
            }
            return $data;
        }

        public function getTemplate(){

            $query = "Select * from college_template";
            $result = mysqli_query($this->conn,$query);
            $data = array();
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    array_push($data,$row);
                }  
            }
            return $data; 
        }

        public function getData($id){
            // print_r($id);
            $query = "Select * from college_template where id='$id'";
            $result = mysqli_query($this->conn,$query);

            if($result->num_rows>0){
                $row=$result->fetch_assoc();
                // print_r($row);
                return $row;
            }
        }

        public function updateTemplate($id){
           
        }

    }
    

    $dbConn = new StaffController(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

?>