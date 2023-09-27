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
            $query = "Select college_name.* from college_name INNER JOIN staff ON staff.college_name=college_name.id where staff.user_id='$user_id'";
            $result = mysqli_query($this->conn,$query);
            $data = array();

            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    array_push($data,$row);
                }
            }
            return $data;
        }

        public function getTemplate($id){
            // print_r($id);
            $query = "Select * from college_template where clg_id='$id'";
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
    }
    

    $dbConn = new StaffController(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);
    
?>