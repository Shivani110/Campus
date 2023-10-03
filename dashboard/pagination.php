<?php require('../config.php');

    class Pagination{
        public $conn;
        public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);
            
            if($this->conn){
            }
        }

        public function post($page){
            $query = "Select *from post";  
            $result = mysqli_query($this->conn, $query);  
            $number_of_result = mysqli_num_rows($result);
            $result_per_page = 4;
            $page_result = ($page-1)* $result_per_page;
            $num_page = ceil($number_of_result/$result_per_page);
            $query = "Select * from post LIMIT " .$page_result.','.$result_per_page;
            $result = mysqli_query($this->conn,$query);

            while($row=$result->fetch_assoc()){
                return $row;
            }
        }

        public function pagepost(){
            $query = "Select *from post";  
            $result = mysqli_query($this->conn, $query);  
            $number_of_result = mysqli_num_rows($result);

            return $number_of_result;
        }

    }

    $dbConn = new Pagination(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

    

?>