<?php
    require("../config.php");

   if($_POST){
        $formdata = $_POST;
      // print_r($formdata);
   }

   if($_FILES){
        $filedata = $_FILES;
      // print_r($filedata);
   }

   $data = array($_POST,$_FILES);
  // print_r($data);
   
    class Sponsor{
       public $conn;
       public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);

            if($this->conn){

            }
       }

        public function updateSponsor($data){
           // print_r($data);
            $user_id = $data['0']['user_id'];
            $about_me = $data['0']['abt_me'];
            $support = $data['0']['support'];
            $social = $data['0']['social'];
            
            if(isset($data['1']['file']['name'])){
                $filename = $data['1']['file']['name'];
                $filetype = $data['1']['file']['type'];
                $tmp = $data['1']['file']['tmp_name'];
                $path = 'uploads/'.$filename;

                $query = "Update sponsor set about_me='$about_me',pictures='$filename',types_of_support='$support',social_links='$social' where user_id='$user_id'";

                $result = mysqli_query($this->conn,$query);

                if($result == true){
                    move_uploaded_file($tmp,$path);
                    echo "success";
                }else{
                    echo mysqli_error($this->conn);
                }

            }else{
                $query = "Update sponsor set about_me='$about_me',types_of_support='$support',social_links='$social' where user_id='$user_id'";

                $result = mysqli_query($this->conn,$query);
    
                if($result == true){
                    echo "done";
                }else{
                    echo mysqli_error($this->conn);
                }
            }
            
        }
    }

    $dbConn = new Sponsor(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

    if($data){
        $sponsor = $dbConn->updateSponsor($data);
    }
  
?>