<?php require("../config.php"); 

    class CreateEvents{
        public $conn;
        public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);

            if($this->conn){

            }
        }

        public function addEvents($data){
            $event_name = $data['event_name'];
            $date = $data['date'];
            $time = $data['time'];
            $venue = $data['venue'];
            $sponsorship = $data['sponsorship'];
            $cost = $data['cost'];
            $guest = $data['guest'];
            $guest_num = $data['guest_num'];
            $created_by = $data['created_by'];
            $affilated_by = $data['affilated_by'];

            $query = "Insert into events (event_name, date, time, venue, sponsorship, cost, guest, guest_number,created_by,affilated_by) VALUES ('$event_name','$date','$time','$venue','$sponsorship','$cost','$guest','$guest_num','$created_by','$affilated_by')";

            $result = mysqli_query($this->conn,$query);

            if($result == true){
                session_start();
                $_SESSION['success'] = "Event created";
                header("location:events.php");
            }else{
                echo mysqli_error($this->conn);
            }
        }

        public function editEvents($data){
            $id = $data['id'];
            $event_name = $data['event_name'];
            $date = $data['date'];
            $time = $data['time'];
            $venue = $data['venue'];
            $sponsorship = $data['sponsorship'];
            $cost = $data['cost'];
            $guest = $data['guest'];
            $guest_num = $data['guest_num'];
            $created_by = $data['created_by'];
            $affilated_by = $data['affilated_by'];

            $query = "Update events set event_name='$event_name',date='$date',time='$time',venue='$venue',sponsorship='$sponsorship',cost='$cost',guest='$guest',guest_number='$guest_num' where id='$id'";

            $result = mysqli_query($this->conn,$query);

            if($result == true){
                header("location:events.php?id=$id");
            }else{
                echo mysqli_error($this->conn);
            }
        }
    }

    $dbConn = new CreateEvents(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

   
    // print_r($_POST);

   if(isset($_POST)){
        $data = $_POST;
   }

   if($data){
        if($data['id'] != ''){
            
            $update = $dbConn->editEvents($data);
        }else{
          
            $create = $dbConn->addEvents($data);
        }
   }
?>