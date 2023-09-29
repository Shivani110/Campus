<?php require('../config.php');

    class Postlikes{
        public $conn;
        public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);
            
            if($this->conn){
            }
        }

        public function likes($data){
            $id = $data['id'];
            $userid = $data['userid'];
            $query = "Select * from post where id = '$id'";
            $result = mysqli_query($this->conn,$query);
            // $data = array();
            if($result->num_rows>0){
                $row=$result->fetch_assoc();
                $id = $row['id'];
                $like = $row['likes'];
                $likes = json_decode($like);

                // print_r($_SESSION);
                if(in_array($userid, $likes)){
                 echo 'not done';
                }else{
                    echo 'done';
                }

                // if($user == null){
                //     echo 'done';
                // }else{
                   
                // }

                // foreach($likes as $val){

                // }
                

                if($like == '' || $like == null){
                   $likes = array($userid);
                }else{
                    array_push($likes,$userid);
                }

                $likesarr = json_encode($likes);
                // print_r(array_values($likes));
                die();

                $query = "Update post set likes='$likesarr' where id='$id'";
                $result = mysqli_query($this->conn,$query);

                if($result == true){
                    echo 'updated';
                }else{
                    echo mysqli_error($this->conn);
                }
            
            }
            
        }
    }

    $dbConn = new Postlikes(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

    $json = file_get_contents('php://input');
    $data = (array)json_decode($json);

    if($data){
        $likepost = $dbConn->likes($data);
    }
    