<?php require('../config.php');

    class Comments{
        public $conn;
        public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);
            
            if($this->conn){
            }
        }

        public function postcomments($data){
            // print_r($data);

           $id = $data['id'];
           $userid = $data['userid'];
           $comment = $data['comment'];
        
           $query = "Select * from public_posts where id = '$id'";
           $result = mysqli_query($this->conn,$query);

           if($result->num_rows>0){
                $row=$result->fetch_assoc();
                $id = $row['id'];
                $cmnt = $row['comments'];
                $cmnts = json_decode($cmnt);
                $usercmnts = array($userid=>$comment);

                if($cmnt == null || $cmnt == ''){
                    $cmnts = array($usercmnts);
                }else{
                   array_push($cmnts,$usercmnts);
                }

                $cmntarr = json_encode($cmnts);
                
                $query = "Update public_posts set comments='$cmntarr' where id='$id'";
                $result = mysqli_query($this->conn,$query);

                if($result == true){
                   return $result;
                }else{
                    echo mysqli_error($this->conn);
                }

            }
        }
    }

    $dbConn = new Comments(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

    $json = file_get_contents('php://input');
    $data = (array)json_decode($json);

    if($data){
        $comments = $dbConn->postcomments($data);
        print_r(json_encode($comments));
    }



   
    