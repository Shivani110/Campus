<?php require('../config.php'); 
   
    class StarWeek{
       public $conn;
       public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);

            if($this->conn){

            }
       }

        public function starofevent($data){
            $name = $data['name'];
            $role = $data['role'];
            $modid = $data['user_id'];
            $clgid = $data['clg_id'];

            if(isset($data['slug'])){
                $slug = $data['slug'];
                $uniqueslug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($slug)));
                $query = "Select slug from event_star where slug like '$uniqueslug%'";
                $result = mysqli_query($this->conn,$query);

                if($result->num_rows>0){
                    $row=$result->fetch_assoc();
                    header("location:eventStar.php?error=Slug already exist");
                }else{
                    $query = "Insert into event_star(event_name, slug, role, mod_id, clg_id) Values ('$name','$slug','$role','$modid','$clgid')";
                    $result = mysqli_query($this->conn,$query);
                    if($result == true){
                        session_start();
                        $_SESSION['success'] = 'Inserted';
                        header("location:eventStar.php");
                    }else{
                        echo mysqli_error($this->conn);
                    }
                }
            }
        }

        public function editeventStar($data){
            $id = $data['id'];
            $name = $data['name'];
            $role = $data['role'];
            $slug = $data['slug'];

            $query = "Select * from event_star where id = '$id'";
            $result = mysqli_query($this->conn,$query);
            if($result->num_rows>0){
                $row = $result->fetch_assoc();
                
                $query = "Update event_star set event_name='$name',slug='$slug',role='$role' where id='$id'";
                $result = mysqli_query($this->conn,$query);

                if($result == true){
                    header("location:eventStar.php?id=$id");
                }else{
                    echo mysqli_error($this->conn);
                }
            }
        }
        
    }

    $dbConn = new StarWeek(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

    if(isset($_POST)){
        if($_POST['id'] != null){
            $update = $dbConn->editeventStar($_POST);
        }else{
            $star = $dbConn->starofevent($_POST);
            print_r(json_encode($star));
        }
        
    }
  
?>
