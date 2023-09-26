<?php
    require('../config.php');

    class Remove{
        public $conn;
        public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);

            if($this->conn){
             
            }
        }

        public function removeData($data){
            // print_r($data);

            $id = $data[0];
            $key = $data[1];

            $query = "Select * from college_template where id = '$id'";
            $result = mysqli_query($this->conn,$query);

            if($result->num_rows>0){
                $row = $result->fetch_assoc();
                $image = $row['third_section_image'];
                $text = $row['third_section_image_txt'];
                
                $imgarr = json_decode($image);
                $txtarr = json_decode($text);
                $updateimages = array();
                $updatetext = array();
                for ($i=0; $i <count($imgarr) ; $i++) { 

                    if($i == $key){
                        continue;
                    }
                    array_push($updateimages,$imgarr[$i]);
                    array_push($updatetext,$txtarr[$i]);
                }

                $img = json_encode($updateimages);
                $txt = json_encode($updatetext);

                $query = "Update college_template set third_section_image = '$img', third_section_image_txt='$txt' where id='$id'";
                $result = mysqli_query($this->conn,$query);

                if($result == true){
                    return "updated";
                }else{
                    echo mysqli_error($this->conn);
                }
                return $row;
            }
            
        }

    }
    

    $dbConn = new Remove(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

    //print_r($_POST);

    if($_POST){
        $id = $_POST['id'];
        $key = $_POST['key'];

        $data = array($id,$key);

        $remove = $dbConn->removeData($data);
        print_r($remove);
    }

?>