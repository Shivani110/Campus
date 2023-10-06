<?php require('../config.php');

    class JoinEvents{
        public $conn;
        public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);
            
            if($this->conn){
            }
        }

        public function joinevent($data){
            $id = $data['id'];
            $userid = $data['userid'];
            $query = "Select * from events where id='$id'";
            $result = mysqli_query($this->conn,$query);

            if($result->num_rows>0){
                $row=$result->fetch_assoc();

                $id = $row['id'];
                $eventguest = $row['event_guest'];
                $guests = json_decode($eventguest);

                if($eventguest == null || $eventguest == ''){
                    $guests = array($userid);
                }else{
                    array_push($guests,$userid);
                }
                $guestarr = json_encode($guests);

                $query = "Update events set event_guest='$guestarr' where id='$id'";
                $result = mysqli_query($this->conn,$query);

                if($result == true){
                    return "updated";
                }else{
                    echo mysqli_error($this->conn);
                }
                
            }
        }   
                   
    }

    $dbConn = new JoinEvents(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

    $json = file_get_contents('php://input');
    $data = (array)json_decode($json);
    
    if($data){
        $join = $dbConn->joinevent($data);
        print_r(json_encode($join));
    }
    