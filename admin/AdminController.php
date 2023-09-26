<?php
    require("../config.php");

    class AdminController{
        public $conn;
		public function __construct($host,$user,$password,$db){
			$this->conn = mysqli_connect($host,$user,$password,$db);
			
			if($this->conn){
			}
				
		}


        public function showUser($data){
            $query = "Select * from users where is_admin='0' AND is_approved='0' ";
            $result = mysqli_query($this->conn,$query);
            $data = array();
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    // print_r($row);
                    array_push($data,$row);
                }
                
            }
            return $data;
        }

        public function showCollege(){
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

        public function editCollege($id){

            $query = "Select * from college_name where id = '$id' ";
            $result = mysqli_query($this->conn,$query);
            $data = array();

            if($result->num_rows>0){
                $row=$result->fetch_assoc();
                // print_r($row);
                return $row;
            }
        }

        public function approvedUser(){
            $query = "Select * from users where is_admin='0' and is_approved ='1'";
            $result = mysqli_query($this->conn,$query);
            $data = array();

            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    array_push($data,$row);
                }
            }
            return $data;
        }

        public function selectModerator($id){
           $query = "Select users.id,users.realname,staff.about_me,college_name.college_name from users 
                INNER JOIN staff ON staff.user_id=users.id
                INNER JOIN college_name ON college_name.id=staff.college_name where user_type='2' and college_name.id='$id'";

            $result = mysqli_query($this->conn,$query);

           // print_r($result);
           $data = array();

           if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    //print_r($row);
                    array_push($data,$row);
                    //print_r($data);
                }
           }
            return $data;
        }
    }

    

    $dbConn = new AdminController(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

?>