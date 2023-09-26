<?php
require("../config.php");

$json = file_get_contents('php://input');

$data =(array) json_decode($json);

//print_r($data);

class Status{
    public $conn;
    public function __construct($host,$user,$password,$db){
        $this->conn = mysqli_connect($host,$user,$password,$db);
        
        if($this->conn){
        }
    }

    public function update($id){
        // print_r($id);
        $query = "Select * from users where id=$id";
        $result = mysqli_query($this->conn,$query);
    
        if($result->num_rows>0){
            $row = mysqli_fetch_array($result);

            $user_type = $row['user_type'];
            $id = $row['id'];

            if($user_type == '1'){
                $query = "Insert into student (user_id) values('$id')";
                $result = mysqli_query($this->conn,$query);

                if($result == true){
                    $response = array();
                    $query = "UPDATE users SET is_approved=1 WHERE id=$id";
                    $result = mysqli_query($this->conn,$query);
            
                    if($result == TRUE){
                        $response = array('success'=> true, 'msg' =>'Successfully approved!');
                        return $response;
                    }
                }
            }else if($user_type == '2'){
                $query = "Insert into staff (user_id) values('$id')";
                $result = mysqli_query($this->conn,$query);

                if($result == true){
                    $response = array();
                    $query = "UPDATE users SET is_approved=1 WHERE id=$id";
                    $result = mysqli_query($this->conn,$query);
            
                    if($result == TRUE){
                        $response = array('success'=> true, 'msg' =>'Successfully approved!');
                        return $response;
                    }
                }
            }else if($user_type == '3'){
                $query = "Insert into sponsor (user_id) values ('$id')";
                $result = mysqli_query($this->conn,$query);

                if($result == true){
                    $response = array();
                    $query = "UPDATE users SET is_approved=1 WHERE id=$id";
                    $result = mysqli_query($this->conn,$query);
            
                    if($result == TRUE){
                        $response = array('success'=> true, 'msg' =>'Successfully approved!');
                        return $response;
                    }
                }
            }else if($user_type == '4'){
                $query = "Insert into alumni (user_id) values ('$id')";
                $result = mysqli_query($this->conn,$query);

                if($result == true){
                    $response = array();
                    $query = "UPDATE users SET is_approved=1 WHERE id=$id";
                    $result = mysqli_query($this->conn,$query);
            
                    if($result == TRUE){
                        $response = array('success'=> true, 'msg' =>'Successfully approved!');
                        return $response;
                    }
                }
            }
        }
    }

    public function collegName($data){
           
        $response = array();
       
        $clg = $data['clg'];
        $loc = $data['loc'];
        $mod = $data['mod'];
        $id = $data['id'];
        
        if($id){
            $query = "Update college_name set college_name='$clg', location='$loc', moderator='$mod' where id='$id'";
            $result = mysqli_query($this->conn,$query);

            if($result == true){
                $response = array('success'=> true, 'msg' => 'edited');
                return $response;
            }

        }else{
            $query = "Insert into college_name (college_name,location) values ('$clg','$loc')";
            $result = mysqli_query($this->conn,$query);

            if($result == true){
                $response = array('success'=> true, 'msg' =>'Submitted');
                // echo json_encode($response);
                return $response;
            }
        }
    }

    public function deleteCollege($id){
           
        $query = "Delete from college_name where id = '$id' ";
      
        if($this->conn->query($query) == true){
           return true;
        }else{
            echo "error";
        }

    }

    public function disapproveUser($id){

        $query = "Delete from users where id='$id'";
        $result = mysqli_query($this->conn,$query);

        if($result == true){
            return true;
        }else{
            echo mysqli_error($this->conn);
        }
    }
}


$dbConn = new Status(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);


if($data['action'] == "add"){

// For Add College name
    $add = $dbConn->collegName($data);
    print_r(json_encode('addedd'));

}else if($data['action'] == "delete"){

// For Delete College name

    $id = $data['id'];
    $delete = $dbConn->deleteCollege($id);
    print_r(json_encode('deleted'));

}else if($data['action'] == "approved"){

// For Approved Users

    $id = $data['id'];
    $approved = $dbConn->update($id);
    print_r(json_encode('approved'));

}else if($data['action'] == "disapproved"){

// For Disapproved Users

    $id = $data['id'];
    $disapproved = $dbConn->disapproveUser($id);
    print_r(json_encode('disapproved'));

}


?>