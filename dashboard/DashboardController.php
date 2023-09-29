<?php require('../config.php');

    class DashboardController{
        public $conn;
        public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);
            
            if($this->conn){
            }
        }

        public function viewCollege(){
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
        
       public function template($id){
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

        public function collegeTemplate($id){
            $query = "Select * from college_template where id = '$id'";
            $result = mysqli_query($this->conn,$query);
            
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    // print_r($row);
                    return $row;
                }
            }
        }

        public function viewPost($id){
            $query="Select * from post where clg_id='$id'";
            $result = mysqli_query($this->conn,$query);
            $data = array();
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    array_push($data,$row);
                    // print_r($data);
                }
            }
            return $data;
        }
    }

    $dbConn = new DashboardController(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

    
?>