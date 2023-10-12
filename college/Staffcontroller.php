<?php
    require('../config.php');

    class StaffController{
        public $conn;
        public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);

            if($this->conn){
             
            }
        }

        public function collegeName(){
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

        public function getStaff($id){
            //print_r($id);
            $query = "Select * from staff where user_id='$id'";
            $result = mysqli_query($this->conn,$query);
            $data = array();

            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    array_push($data,$row);
                    //print_r($data);
                }
            }
            return $data;
        }

        public function getCollege($data){
            $user_id = $data[0];
            $query = "Select college_name.* from college_name INNER JOIN staff ON staff.college_name=college_name.id where staff.user_id='$user_id'";
            $result = mysqli_query($this->conn,$query);
            $data = array();

            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    array_push($data,$row);
                }
            }
            return $data;
        }

        public function getTemplate($id){
            // print_r($id);
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

        public function getData($id){
            // print_r($id);
            $query = "Select * from college_template where id='$id'";
            $result = mysqli_query($this->conn,$query);

            if($result->num_rows>0){
                $row=$result->fetch_assoc();
                // print_r($row);
                return $row;
            }
        }

        public function getPost($id){
            $query = "Select * from post where clg_id='$id'";
            $result = mysqli_query($this->conn,$query);
            $data = array();
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    array_push($data,$row);
                    // echo '<pre>';
                    // print_r($data);
                    // echo '</pre>';
                }
            }
            return $data;
        }

        public function posts($id){
            $query = "Select * from post where id='$id'";
            $result = mysqli_query($this->conn,$query);
            $data = array();
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    array_push($data,$row);
                }
            }
            return $data;
        }

        public function getevents($id){
            $query = "Select * from events where affilated_by='$id'";
            $result = mysqli_query($this->conn,$query);
            $data = array();
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    array_push($data,$row);
                }
            }
            return $data;
        }

        public function events($id){
            $query = "Select * from events where id='$id'";
            $result = mysqli_query($this->conn,$query);
            $data = array();
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    array_push($data,$row);
                }
            }
            return $data;
        }

        public function eventusers($data){
            $query = "Select user_type from users where id='$data'";
            $result = mysqli_query($this->conn,$query);

            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    $usertype = $row['user_type'];

                    if($usertype == 0){
                        $query = "SELECT users.user_type,users.realname,users.phone FROM users
                        WHERE users.user_type=0 and users.id = '$data'";

                        $result = mysqli_query($this->conn,$query);

                        if($result->num_rows>0){
                
                            while($row=$result->fetch_assoc()){
                    
                                return $row;
                            }
                        }
                    }else if($usertype == 1){
                        $query = "SELECT users.user_type,users.realname,users.email,users.phone,student.pictures FROM users
                        INNER JOIN student ON student.user_id = users.id WHERE users.id = '$data'";

                        $result = mysqli_query($this->conn,$query);

                        if($result->num_rows>0){
                
                            while($row=$result->fetch_assoc()){
                    
                                return $row;
                            }
                        }
                    } else if($usertype == 2){
                        $query = "SELECT users.user_type,users.realname,users.email,users.phone,staff.pictures FROM users
                        INNER JOIN staff ON staff.user_id = users.id WHERE users.id = '$data'";

                        $result = mysqli_query($this->conn,$query);

                        if($result->num_rows>0){
                
                            while($row=$result->fetch_assoc()){
                    
                                return $row;
                            }
                        }
                    }else if($usertype == 3){
                        $query = "SELECT users.user_type,users.realname,users.email,users.phone,sponsor.pictures FROM users
                        INNER JOIN sponsor ON sponsor.user_id = users.id WHERE users.id = '$data'";
                        
                        $result = mysqli_query($this->conn,$query);

                        if($result->num_rows>0){
                
                            while($row=$result->fetch_assoc()){
                    
                                return $row;
                            }
                        }
                    }else if($usertype == 4){
                        $query = "SELECT users.user_type,users.realname,users.email,users.phone,alumni.pictures FROM users
                        INNER JOIN alumni ON alumni.user_id = users.id WHERE users.id = '$data'";
                        
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

        public function getEventStar($id){
            $query = "Select * from event_star where mod_id='$id'";
            $result = mysqli_query($this->conn,$query);
            $data = array();
            
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    array_push($data,$row);
                }
            }
            return $data;
        }

        public function eventstar($id){
            $query = "Select * from event_star where id='$id'";
            $result = mysqli_query($this->conn,$query);
            
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    return $row;
                }
            }
        }
    }
    
    

    $dbConn = new StaffController(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);
    
    
?>