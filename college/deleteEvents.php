<?php 
    require("../config.php");

    class DeleteEvents{
        public $conn;
        public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);
            if($this->conn){

            }
        }

        public function eventsDelete($id){
            $query = "Delete from events where id='$id'";
            $result = mysqli_query($this->conn,$query);
            if($result == true){
                return true;
            }else{
                echo mysqli_error($this->conn);
            }
        }
    }

    $dbConn = new DeleteEvents(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

  
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    
   if($data){
        $delete = $dbConn->eventsDelete($data);
        print_r(json_encode('deleted'));
   }
?>