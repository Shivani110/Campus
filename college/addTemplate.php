<?php require("../config.php"); 

    class AddTemplate{
        public $conn;

        public function __construct($host,$user,$password,$db){
            $this->conn = mysqli_connect($host,$user,$password,$db);
        
            if($this->conn){
            }
        }

        public function clgTemplate($data){
            $first_title = $data[0]['first_title'];
            $first_des = $data[0]['first_des'];
            $first_btn = $data[0]['first_btn'];
            $second_text = $data[0]['second_text'];
            $third_title = $data[0]['third_title'];
            $third_sub_title = $data[0]['third_sub_title'];
           
            $third_btn_txt = $data[0]['third_btn_txt'];
            $four_title = $data[0]['fourth_title'];
            $fourth_des = $data[0]['fourth_des'];
            $fourth_btn_txt = $data[0]['fourth_btn_txt'];
            $fifth_title = $data[0]['fifth_title'];
            $fifth_subtitle = $data[0]['fifth_subtitle'];
            $fifth_text = $data[0]['fifth_text'];
            $last_text = $data[0]['last_text'];
            $fb_link = $data[0]['fb_link'];
            $twitter_link = $data[0]['twitter_link'];
            $insta_link = $data[0]['insta_link'];
            $linkdn_link = $data[0]['linkdn_link'];
            $clg_id = $data[0]['clg_id'];
            $aff_by = $data[0]['aff_by'];
          
            $text = array();
            if(isset($data[0]['third_img_txt'])){
                $third_img_txt = $data[0]['third_img_txt'];

                for($i=0;$i<count($third_img_txt);$i++){
                    $imgtxt = $third_img_txt[$i];
                    array_push($text,$imgtxt);
                }
            }else{
                $third_img_txt = [];
            }

            $jsontext = json_encode($text);
           // print_r($jsontext);

            $logo = $data[1]['logo']['name'];
            $logo_tmp_name = $data['1']['logo']['tmp_name'];
            $first_img = $data[1]['first_back_img']['name'];
            $first_tmp_name = $data[1]['first_back_img']['tmp_name'];
            $sec_img = $data[1]['second_img']['name'];
            $sec_tmp_name = $data[1]['second_img']['tmp_name'];
            
            $four_img = $data[1]['fourth_back_img']['name'];
            $four_tmp_name = $data[1]['fourth_back_img']['tmp_name'];
          
            $images = array();

            if(isset($data[1]['third_img']['name'])){
                $third_img = $data[1]['third_img']['name'];
                $third_tmp_name = $data[1]['third_img']['tmp_name'];

                for($i=0;$i<count($third_img);$i++){
                    $name = $third_img[$i];
                    $tmp = $third_tmp_name[$i];
                    $path = 'uploads/'.$name;
                    move_uploaded_file($tmp,$path);
                    array_push($images,$name);
                }
            }else{
                $third_img = [];
            }
            
            $jsonimages = json_encode($images);
            //print_r($jsonimages);

            $path = 'uploads/'.$logo;
            move_uploaded_file($logo_tmp_name,$path);

            $path = 'uploads/'.$first_img;
            move_uploaded_file($first_tmp_name,$path);

            $path = 'uploads/'.$sec_img;
            move_uploaded_file($sec_tmp_name,$path);

            $path = 'uploads/'.$four_img;
            move_uploaded_file($four_tmp_name,$path);

            $query = "Insert into college_template (logo,first_section_title,first_section_description,first_section_background_img,first_section_button_text,second_section_left_textarea,second_section_right_image,third_section_title,third_section_subtitle,third_section_image,third_section_image_txt,third_section_button_txt,fourth_section_title,fourth_section_description,fourth_section_button_txt,fourth_section_background_img,fifth_section_title,fifth_section_subtitle,fifth_section_textarea,last_section_textarea,last_section_fb_link,last_section_twitter_link,last_section_instagram_link,last_section_linkedin_link,clg_id,affilated_by) VALUES ('$logo','$first_title','$first_des','$first_img','$first_btn','$second_text','$sec_img','$third_title','$third_sub_title','$jsonimages','$jsontext','$third_btn_txt','$four_title','$fourth_des','$fourth_btn_txt','$four_img','$fifth_title','$fifth_subtitle','$fifth_text','$last_text','$fb_link','$twitter_link','$insta_link','$linkdn_link','$clg_id','$aff_by')";

            $result = mysqli_query($this->conn,$query);

            if($result == true){
                session_start();
                $_SESSION['success']="College Template Successfully Created";
                header("location:collegeTemplate.php");
            }else{
                echo mysqli_error($this->conn);
            }
        }

        public function updateTemplate($data){
            $id = $data[0]['id'];
            $query = "Select * from college_template where id='$id'";
            $result = mysqli_query($this->conn,$query);

            if($result->num_rows){
                $row=$result->fetch_assoc();
                // print_r($data);
                // die();
                $img = json_decode($row['third_section_image']);
                $txt = json_decode($row['third_section_image_txt']);


                $first_title = $data[0]['first_title'];
                $first_des = $data[0]['first_des'];
                $first_btn = $data[0]['first_btn'];
                $second_text = $data[0]['second_text'];
                $third_title = $data[0]['third_title'];
                $third_sub_title = $data[0]['third_sub_title'];
                $third_btn_txt = $data[0]['third_btn_txt'];
                $four_title = $data[0]['fourth_title'];
                $fourth_des = $data[0]['fourth_des'];
                $fourth_btn_txt = $data[0]['fourth_btn_txt'];
                $fifth_title = $data[0]['fifth_title'];
                $fifth_subtitle = $data[0]['fifth_subtitle'];
                $fifth_text = $data[0]['fifth_text'];
                $last_text = $data[0]['last_text'];
                $fb_link = $data[0]['fb_link'];
                $twitter_link = $data[0]['twitter_link'];
                $insta_link = $data[0]['insta_link'];
                $linkdn_link = $data[0]['linkdn_link'];

                if(isset($data[0]['third_img_txt'])){
                    $third_img_txt = $data[0]['third_img_txt'];
                    for($i=0;$i<count($third_img_txt);$i++){
                        $imgtxt = $third_img_txt[$i];
                        array_push($txt,$imgtxt);
                    }
                }else{
                    $third_img_txt = $row['third_section_image_txt'];
                }
               
                $jsontext = json_encode($txt);

                if($data[1]['logo']['name'] != null){
                    $logo = $data[1]['logo']['name'];
                    $logo_tmp_name = $data['1']['logo']['tmp_name'];
                    $path = 'uploads/'.$logo;
                    move_uploaded_file($logo_tmp_name,$path);
                }else{
                    $logo = $row['logo'];
                }

                if($data[1]['first_back_img']['name'] != null){
                    $first_img = $data[1]['first_back_img']['name'];
                    $first_tmp_name = $data[1]['first_back_img']['tmp_name'];
                    $path = 'uploads/'.$first_img;
                    move_uploaded_file($first_tmp_name,$path);
                }else{
                    $first_img = $row['first_section_background_img'];
                }

                if($data[1]['second_img']['name'] != null){
                    $sec_img = $data[1]['second_img']['name'];
                    $sec_tmp_name = $data[1]['second_img']['tmp_name'];
                    $path = 'uploads/'.$sec_img;
                    move_uploaded_file($sec_tmp_name,$path);
                }else{
                    $sec_img = $row['second_section_right_image'];
                }

                if(isset($data[1]['third_img']['name'])){
                    $third_img = $data[1]['third_img']['name'];
                    $third_tmp_name = $data[1]['third_img']['tmp_name'];

                    for($i=0;$i<count($third_img);$i++){
                        $name = $third_img[$i];
                        $tmp = $third_tmp_name[$i];
                        $path = 'uploads/'.$name;
    
                        move_uploaded_file($tmp,$path);
    
                        array_push($img,$name);
                    }
                }else{
                    $third_img = $row['third_section_image'];
                }

                $jsonimages = json_encode($img);

                if($data[1]['fourth_back_img']['name'] != null){
                    $four_img = $data[1]['fourth_back_img']['name'];
                    $four_tmp_name = $data[1]['fourth_back_img']['tmp_name'];
                    $path = 'uploads/'.$four_img;
                    move_uploaded_file($four_tmp_name,$path);
                }else{
                    $four_img = $row['fourth_section_background_img'];
                }

                $query = "Update college_template set logo='$logo',first_section_title='$first_title',first_section_description='$first_des',first_section_background_img='$first_img',first_section_button_text='$first_btn',second_section_left_textarea='$second_text',second_section_right_image='$sec_img',third_section_title='$third_title',third_section_subtitle='$third_sub_title',third_section_image='$jsonimages',third_section_image_txt='$jsontext',third_section_button_txt='$third_btn_txt',fourth_section_title='$four_title',fourth_section_description='$fourth_des',fourth_section_button_txt='$fourth_btn_txt',fourth_section_background_img='$four_img',fifth_section_title='$fifth_title',fifth_section_subtitle='$fifth_subtitle',fifth_section_textarea='$fifth_text',last_section_textarea='$last_text',last_section_fb_link='$fb_link',last_section_twitter_link='$twitter_link',last_section_instagram_link='$insta_link',last_section_linkedin_link='$linkdn_link' where id='$id'";

                $result = mysqli_query($this->conn,$query);

                if($result==true){
                   header("location:collegeTemplate.php?id=$id");
                }else{
                    echo mysqli_error($this->conn);
                }

            }else{
                echo mysqli_error($this->conn);
            }
            }
        }

    $dbConn = new AddTemplate(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);

    if(isset($_POST)){
        $post = $_POST;
    }
    

    if(isset($_FILES)){
        $files = $_FILES;
    }else{
        $files = null;
    }

    $data = array($post,$files);

    if($data){
        if($data[0]['id'] != ''){
            $update = $dbConn->updateTemplate($data);
        }else{
            echo 'done';
            $create = $dbConn->clgTemplate($data);
        }
    }

    
?>
