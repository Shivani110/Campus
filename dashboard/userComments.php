<?php require('../config.php');

    class UserComments{
        public $conn;
        public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);
            
            if($this->conn){
            }
        }

        public function getusername($id){
            $query = "Select users.realname from users where id='$id'";
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

    $dbConn = new UserComments(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

    $json = file_get_contents('php://input');
    $data = (array)json_decode($json);

    // print_r($data['id']);

    if($data){
        $id = $data['id'];

        $users = $dbConn->getusername($id);
        print_r(json_encode($users));
    }
    



    