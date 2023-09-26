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
            // print_r($id);
            $query = "Select * from college_template INNER JOIN college_name ON college_name.moderator=college_template.affilated_by where college_name.id='$id'";
            
            $result = mysqli_query($this->conn,$query);
            $data = array();
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    array_push($data,$row);
                    // echo '<pre>';
                    //     print_r($data);
                    // echo '</pre>';
                }
            }
            return $data;
        }
    }

    $dbConn = new DashboardController(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

?>