<?php require_once("../config.php");

    class CreatePosts{
        public $conn;
        public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);

            if($this->conn){

            }
        }

        public function posts($data){
            $image = $data[1]['image']['name'];
            $tmp = $data[1]['image']['tmp_name'];
            $path = 'uploads/'.$image;

            $text = $data[0]['txt'];
            $user_id = $data[0]['userid'];

            $query = "Insert into public_posts (image,text,user_id) values ('$image','$text','$user_id')";
            $result = mysqli_query($this->conn,$query);

            if($result == true){
                move_uploaded_file($tmp,$path);
                session_start();
                $_SESSION['success'] = "Successfully inserted";
                header("location:addpost.php");
            }else{
                echo mysqli_error($this->conn);
            }
        }

        public function updatePost($data){
            $id = $data[0]['post_id'];
            $query = "Select * from public_posts where id='$id'";
            $result = mysqli_query($this->conn,$query);

            if($result->num_rows>0){
                $row=$result->fetch_assoc();

                $img = $row['image'];
                $text = $row['text'];

                if($data[1]['image']['name'] != null){
                    echo 'done';
                    $img_name = $data[1]['image']['name'];
                    $tmp = $data[1]['image']['tmp_name'];
                    $path = 'uploads/'.$img_name;
                    move_uploaded_file($tmp,$path);
                }else{
                    echo 'not done';
                    $img_name = $row['image'];
                }
                
                if($data[0]['txt'] != null){
                    $text = $data[0]['txt'];
                    $query = "Update public_posts set image='$img_name',text='$text' where id='$id'";
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

    $dbConn = new CreatePosts(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

   if(isset($_POST)){
        $post = $_POST;
   }

   if(isset($_FILES)){
        $file = $_FILES;
   }

   $data = array($post,$file);

   if($data){
        if($data[0]['post_id'] != ''){ 
            $update = $dbConn->updatePost($data);
        }else{
            $create = $dbConn->posts($data);
        }
    }
?>