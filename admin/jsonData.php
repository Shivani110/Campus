<?php
    require("../config.php");

    class jsonData{
        public $conn;
		public function __construct($host,$user,$password,$db){
			$this->conn = mysqli_connect($host,$user,$password,$db);
			
			if($this->conn){
			}
				
		}

        public function deleteUser($id){
            // print_r($id);
           
            $query = "Select * from users where id='$id'";
            $result = mysqli_query($this->conn,$query);

            if($result->num_rows>0){
                $row = mysqli_fetch_array($result);
                // print_r($row);
                
                $id = $row['id'];
                $role = $row['user_type'];

                if($role == '1'){
                    $query = "Delete student,users from student INNER JOIN users ON student.user_id = users.id WHERE users.id = '$id'";

                    $result = mysqli_query($this->conn,$query);

                    if($result == true){
                        $response = array('success'=> true, 'msg' =>'Deleted!!');
                        return $response;
                    }
                }else if($role == '2'){
                    $query = "Delete staff,users from staff INNER JOIN users ON staff.user_id = users.id WHERE users.id='$id'";

                    $result = mysqli_query($this->conn,$query);

                    if($result == true){
                        $response = array('success'=> true, 'msg' =>'Deleted!!');
                        return $response;
                    }
                }else if($role == '3'){
                    $query = "Delete sponsor,users from sponsor INNER JOIN users ON sponsor.user_id = users.id WHERE users.id='$id'";

                    $result = mysqli_query($this->conn,$query);
                    if($result == true){
                        $response = array('success'=> true, 'msg' =>'Deleted!!');
                        return $response;
                    }
                }else if($role == '4'){
                    $query = "Delete alumni,users from alumni INNER JOIN users ON alumni.user_id = user.id WHERE users.id='$id'";

                    $result = mysqli_query($this->conn,$query);
                    if($result == true){
                        $response = array('success'=> true, 'msg' =>'Deleted!!');
                        return $response;
                    }
                }
            }
        }
    }

    $dbConn = new jsonData(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

    $json = file_get_contents('php://input');

    $data =(array) json_decode($json);

    // print_r($data);

    if($data){
        $id = $data['id'];
        $delete = $dbConn->deleteUser($id);
        print_r(json_encode($delete));
    }
   
?>