<?php require('../config.php');

    class PostSearch{
        public $conn;
        public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);
            
            if($this->conn){
            }
        }

        public function search($data){
            $query = "Select users.realname,users.user_type,public_posts.* from users 
            INNER JOIN public_posts ON public_posts.user_id=users.id 
            where public_posts.text like '$data%'";

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

    $dbConn = new PostSearch(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

    $json = file_get_contents('php://input');
    $data = (array)json_decode($json);

    if($data){
        $a = $data['search'];
        $searchpost = $dbConn->search($a);
        print_r(json_encode($searchpost));
    }



    