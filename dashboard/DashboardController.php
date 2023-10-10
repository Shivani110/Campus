<?php require('../config.php');

    class DashboardController{
        public $conn;
        public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);
            
            if($this->conn){
            }
        }

        public function viewCollege(){
            $query = "Select * from college_name";
            $result = mysqli_query($this->conn,$query);
            $data = array();
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                  
                    array_push($data,$row);
                }
            }
            return $data;
        }   
        
       public function template($id){
            $query = "Select * from college_template where clg_id='$id'";
            $result = mysqli_query($this->conn,$query);
            $data = array();
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    array_push($data,$row);
                }
            }
            return $data;
        }

        public function collegeTemplate($id){
            $query = "Select * from college_template where id = '$id'";
            $result = mysqli_query($this->conn,$query);
            
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    // print_r($row);
                    return $row;
                }
            }
        }

        public function viewPost($id){
            $query="Select * from post where clg_id='$id'";
            $result = mysqli_query($this->conn,$query);
            $data = array();
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    array_push($data,$row);
                    // print_r($data);
                }
            }
            return $data;
        }

        public function post($data){
            // print_r($data);
           
            $query = "Select *from post";  
            $result = mysqli_query($this->conn, $query);  
            $number_of_result = mysqli_num_rows($result);
            $result_per_page = 4;
            $id = $data[0];
            $page = $data[1];
            $page_result = ($page-1)* $result_per_page;
            $num_page = ceil($number_of_result/$result_per_page);
            $query = "Select * from post where clg_id = $id LIMIT $page_result, $result_per_page ";
            $result = mysqli_query($this->conn,$query);
            $data = array();
           
            while($row=$result->fetch_assoc()){
                // print_r($row);
                array_push($data,$row);
            }
            return $data;
        }

        public function pagepost(){
            $query = "Select * from post where clg_id=$_GET[clgid]";  
            $result = mysqli_query($this->conn, $query);  
            $number_of_result = mysqli_num_rows($result);

            // print_r($number_of_result);
            return $number_of_result;
        }

        public function usersdata($data){
            $id = $data[0];
            $query = "Select username from users where id ='$id'";
            $result = mysqli_query($this->conn,$query);

            $data = array();
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    array_push($data,$row);
                    
                }
            }
            return $data;
        }

        public function totalevents(){
            $query = "Select * from events";  
            $result = mysqli_query($this->conn, $query);  
            $number_of_result = mysqli_num_rows($result);
            return $number_of_result;
        }

        public function eventsperpage($data){
            $query = "Select * from events";  
            $result = mysqli_query($this->conn, $query);  
            $number_of_result = mysqli_num_rows($result);
            $result_per_page = 10;
            $page = $data;
            $page_result = ($page-1)* $result_per_page;
            $num_page = ceil($number_of_result/$result_per_page);
            $query = "Select * from events ORDER BY id DESC LIMIT $page_result, $result_per_page ";
            $result = mysqli_query($this->conn,$query);
            $data = array();
           
            while($row=$result->fetch_assoc()){
                array_push($data,$row);
            }
            return $data;
        }

        public function getusers(){
            $query = "Select users.realname,users.user_type,public_posts.* from users INNER JOIN public_posts
            ON public_posts.user_id=users.id";
            $result = mysqli_query($this->conn,$query);
            $data = array();

            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    array_push($data,$row);
                }
            }
            return $data;
        }

        public function userpictures($id){
            $query = "Select user_type from users where id='$id'";
            $result = mysqli_query($this->conn,$query);

            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    $usertype = $row['user_type'];
                    
                    if($usertype == 1){
                        $query = "Select student.* from users INNER JOIN student ON student.user_id=users.id where user_id='$id'";
                        $result = mysqli_query($this->conn,$query);
                        if($result->num_rows>0){
                            while($row=$result->fetch_assoc()){
                                return $row;
                            }
                        }

                    } elseif($usertype == 2){
                        $query = "Select staff.* from users INNER JOIN staff ON staff.user_id=users.id where user_id='$id'";
                        $result = mysqli_query($this->conn,$query);
                        if($result->num_rows>0){
                            while($row=$result->fetch_assoc()){
                                return $row;
                            }
                        }
                    } elseif($usertype == 3){
                        $query = "Select sponsor.* from users INNER JOIN sponsor ON sponsor.user_id=users.id where user_id='$id'";
                        $result = mysqli_query($this->conn,$query);
                        if($result->num_rows>0){
                            while($row=$result->fetch_assoc()){
                                return $row;
                            }
                        }
                    } elseif($usertype == 4){
                        $query = "Select alumni.* from users INNER JOIN alumni ON alumni.user_id=users.id where user_id='$id'";
                        $result = mysqli_query($this->conn,$query);
                        if($result->num_rows>0){
                            while($row=$result->fetch_assoc()){
                                return $row;
                            }
                        }
                    }
                }
            }
        }
        
        public function userslikes($id){
            $query = "Select likes from public_posts where id='$id'";
            $result = mysqli_query($this->conn,$query);

            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    return $row;
                }
            }
        }
    }

    $dbConn = new DashboardController(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

    
?>