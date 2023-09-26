<?php
    require("../config.php");

   if($_POST){
        $formdata = $_POST;
       //print_r($formdata);
   }

   if($_FILES){
        $filedata = $_FILES;
      // print_r($filedata);
   }

   $data = array($_POST,$_FILES);
  // print_r($data);
   
    class Staff{
       public $conn;
       public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);

            if($this->conn){

            }
       }

        public function updateStaff($data){
            //print_r($data);
            $user_id = $data['0']['user_id'];
            $about_me = $data['0']['abt_me'];
            $college = $data['0']['clg'];
            $position = $data['0']['position'];
            $dept = $data['0']['dept'];
            $social = $data['0']['social'];

            if(isset($data['1']['file']['name'])){
                $filename = $data['1']['file']['name'];
                $filetype = $data['1']['file']['type'];
                $tmp = $data['1']['file']['tmp_name'];
                $path = 'uploads/'.$filename;

                $query = "Update staff set about_me='$about_me',pictures='$filename',college_name='$college',position='$position',department='$dept',social_links='$social' where user_id='$user_id'";

                $result = mysqli_query($this->conn,$query);

                if($result == true){
                    move_uploaded_file($tmp,$path);
                    echo "successfully updated";
                }else{
                    echo mysqli_error($this->conn);
                }
            
            }else{
                $query = "Update staff set about_me='$about_me',college_name='$college',position='$position',department='$dept',social_links='$social' where user_id='$user_id'";

                $result = mysqli_query($this->conn,$query);

                if($result == true){
                    echo "done";
                }else{
                    echo mysqli_error($this->conn);
                }
            }
        }
    }

    $dbConn = new Staff(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

    if($data){
        $staff = $dbConn->updateStaff($data);
    }
  
?>