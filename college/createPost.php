<?php 
    require('../config.php');

    class CreatePost{
        public $conn;
        public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);

            if($this->conn){

            }
        }

        public function addPost($data){
            if(isset($data[1]['image']['name'])){
                $image = $data[1]['image']['name'];
                $img_tmp_name = $data[1]['image']['tmp_name'];
                $path = 'uploads/'.$image;

                $text = $data[0]['txt'];
                $clg_id = $data[0]['clg_id'];
                $query = "Insert into post (text,image,clg_id) values ('$text','$image','$clg_id')";
                $result = mysqli_query($this->conn,$query);

                if($result == true){
                    move_uploaded_file($img_tmp_name,$path);
                    session_start();
                    $_SESSION['success'] = "Post created";
                    header("location:addpost.php");
                }else{
                    echo mysqli_error($this->conn);
                }
            }
        }

        public function editPost($data){
            // print_r($data);
            $id = $data[0]['id'];

            $query = "Select * from post where id = '$id'";
            $result = mysqli_query($this->conn,$query);
            if($result->num_rows>0){
                $row=$result->fetch_assoc();

                $img = $row['image'];
                $txt = $row['text'];

                if($data[1]['image']['name'] != null){
                    $image = $data[1]['image']['name'];
                    $img_tmp_name = $data[1]['image']['tmp_name'];
                    $path = 'uploads/'.$image;
                    move_uploaded_file($img_tmp_name,$path);
                }else{
                    $image = $row['image'];
                }

                if($data[0]['txt'] != null){
                    $text = $data[0]['txt'];
                    $query = "Update post set image='$image',text='$text' where id='$id'";
                    $result = mysqli_query($this->conn,$query);
    
                    if($result == true){
                        header("location:addpost.php?id=$id");
                    }else{
                        echo mysqli_error($this->conn);
                    }
                }
            }
        }
    }

    $dbConn = new CreatePost(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

    if(isset($_POST)){
        $post = $_POST;
    }

    if(isset($_FILES)){
        $file = $_FILES;
    }

    $data = array($_POST,$_FILES);

    if($data){
        if($data[0]['id'] != ''){ 
            $update = $dbConn->editPost($data);
        }else{
            $create = $dbConn->addPost($data);
        }
    }
?>