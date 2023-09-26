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
   
    class Student{
       public $conn;
       public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);

            if($this->conn){

            }
       }

        public function updateStudent($data){
            //print_r($data);
            $user_id = $data['0']['user_id'];
            $about_me = $data['0']['abt_me'];
            $college = $data['0']['clg'];
            $course = $data['0']['course'];
            $level = $data['0']['lev'];
            $state = $data['0']['state'];
            $auth = $data['0']['auth'];
            $social = $data['0']['social'];

            if(isset($data['1']['file']['name'])){
                $filename = $data['1']['file']['name'];
                $filetype = $data['1']['file']['type'];
                $tmp = $data['1']['file']['tmp_name'];
                $path = 'uploads/'.$filename;

                $query = "Update student set about_me='$about_me',pictures='$filename',college_name='$college',course='$course',level='$level',state_of_origin='$state',authenticate_student='$auth',social_link='$social' where user_id='$user_id'";

                $result = mysqli_query($this->conn,$query);

                if($result == true){
                    move_uploaded_file($tmp,$path);
                    echo "success";
                }else{
                    echo mysqli_error($this->conn);
                }
               
            }else{
                $query = "Update student set about_me='$about_me',college_name='$college',course='$course',level='$level',state_of_origin='$state',authenticate_student='$auth',social_link='$social' where user_id='$user_id'";

                $result = mysqli_query($this->conn,$query);

                if($result == true){
                    echo 'ewrerer';
                }
            }
        }
    }

    $dbConn = new Student(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

    if($data){
        $student = $dbConn->updateStudent($data);
    }

    // $college = $dbConn->collegeName();
    // print_r($college);
  
?>