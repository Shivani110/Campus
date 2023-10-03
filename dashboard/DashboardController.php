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

        public function post($data){
            // print_r($data);
           
            $query = "Select *from post";  
            $result = mysqli_query($this->conn, $query);  
            $number_of_result = mysqli_num_rows($result);
            $result_per_page = 4;
            $id = $data[0];
            $page = $data[1];
            $page_result = ($page-1)* $result_per_page;
            $num_page = ceil($number_of_result/$result_per_page);
            $query = "Select * from post where clg_id = $id LIMIT $page_result, $result_per_page ";
            $result = mysqli_query($this->conn,$query);
            $data = array();
           
            while($row=$result->fetch_assoc()){
                // print_r($row);
                array_push($data,$row);
            }
            return $data;
        }

        public function pagepost(){
            $query = "Select *from post where clg_id=$_GET[clgid]";  
            $result = mysqli_query($this->conn, $query);  
            $number_of_result = mysqli_num_rows($result);

            // print_r($number_of_result);
            return $number_of_result;
        }
    }

    $dbConn = new DashboardController(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

    
?>