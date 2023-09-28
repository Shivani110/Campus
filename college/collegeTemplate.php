<?php include_once('header.php');
    
?>
<div class="nk-block nk-block-lg p-4">

</div>
<div class="card card-bordered card-preview">
    <div class="card-inner">
    <?php 
       if(isset($_GET['id'])){
            $id = $_GET['id'];
            $clgtmp = $dbConn->getData($id);
        }

    ?>
        <div class="nk-content col-8">
            <form method="post" id="myform" enctype="multipart/form-data" action="./college/addTemplate.php">
                <h4>First Section</h4>

                    <div class="form-group">
                        <label class="form-label" for="logo">Logo</label>
                        <input type="file" class="form-control" id="logo" name="logo" value="">
                        <?php if(isset($clgtmp['logo'])) { ?>
                            <img src="./college/uploads/<?php echo $clgtmp['logo'];?>" height="100px" width="100px">
                       <?php 
                        }
                        ?>

                    </div>
                    <div class="form-group">
                        <label class="form-label" for="first_title">First Section Title</label>
                        <input type="text" class="form-control" id="first_title" name="first_title" value="<?php if(isset($clgtmp['first_section_title'])){
                            echo $clgtmp['first_section_title'];
                        }
                        ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="first_des">First Section description</label>
                        <textarea class="form-control" id="first_des" name="first_des"><?php if(isset($clgtmp['first_section_description'])){
                            echo $clgtmp['first_section_description'];
                        }?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="first_back_img">First Section Background img</label>
                        <input type="file" class="form-control" id="first_back_img" name="first_back_img" value="">
                        <?php if(isset($clgtmp['first_section_background_img'])){?>
                            <img src="./college/uploads/<?php echo $clgtmp['first_section_background_img'];?>" height="100px" width="100px">
                        <?php 
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="first_btn">First Section button text</label>
                        <input type="text" class="form-control" id="first_btn" name="first_btn" value="<?php if(isset($clgtmp['first_section_button_text'])){
                            echo $clgtmp['first_section_button_text'];
                        }?>">
                    </div>
                    <hr>
                    <h4>Second Section</h4>
                    <div class="form-group">
                        <label class="form-label" for="second_text">Second section left textarea</label>
                        <textarea class="form-control" id="second_text" name="second_text"><?php if(isset($clgtmp['second_section_left_textarea'])){
                            echo $clgtmp['second_section_left_textarea'];    
                        }?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="second_img">Second Section Right Image</label>
                        <input type="file" class="form-control" id="second_img" name="second_img" value="">
                        <?php if(isset($clgtmp['second_section_right_image'])) {?>
                            <img src="./college/uploads/<?php echo $clgtmp['second_section_right_image'];
                        ?>" height="100px" width="100px">
                        <?php
                        }
                        ?>

                    </div>
                    <hr>
                    <h4>Third Section</h4>
                    <div class="form-group">
                        <label class="form-label" for="third_title">Third Section Title</label>
                        <input type="text" class="form-control" id="third_title" name="third_title" value="<?php if(isset($clgtmp['third_section_title'])){
                            echo $clgtmp['third_section_title'];
                        }?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="third_sub_title">Third Section Subtitle</label>
                        <input type="text" class="form-control" id="third_sub_title" name="third_sub_title" value="<?php if(isset($clgtmp['third_section_subtitle'])){
                            echo $clgtmp['third_section_subtitle'];
                        }?>">
                    </div>
                    <div class="multiimage">
                            <?php if(isset($clgtmp)) { 
                                    $images = $clgtmp['third_section_image'];
                                    $text = $clgtmp['third_section_image_txt'];
                                    $imgarr = json_decode($images);
                                    $txtarr = json_decode($text);
                                   
                                    for($i=0;$i<count($imgarr);$i++){?>
                                <div>   
                                    <?php print_r($txtarr[$i]); ?>
                                    <img src="./college/uploads/<?php print_r($imgarr[$i]); ?>" height="100px" width="100px">
                                    <button class="btn btn-danger remove" removekey="<?php echo $i; ?>" btn_id ="<?php echo $clgtmp['id']; ?>" type="button">Remove</button>
                                </div>
                                <?php 
                                    } 
                                }
                            ?>
                    </div>
                    <br>
                        <button class="btn btn-primary" id="btn" type="button">Add more</button> 
                    <br>
                    <br>
                    <div class="form-group">
                        <label class="form-label" for="third_btn_txt">Third Section Button Text</label>
                        <input type="text" class="form-control" id="third_btn_txt" name="third_btn_txt" value="<?php if(isset($clgtmp['third_section_button_txt'])){
                            echo $clgtmp['third_section_button_txt'];
                        }?>">
                    </div>
                    <hr>
                    <h4>Fourth Section</h4>
                    <div class="form-group">
                        <label class="form-label" for="fourth_title">Fourth Section Title</label>
                        <input type="text" class="form-control" id="fourth_title" name="fourth_title" value="<?php if(isset($clgtmp['fourth_section_title'])){
                            echo $clgtmp['fourth_section_title'];
                        }?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="fourth_des">Fourth Section description</label>
                        <textarea class="form-control" id="fourth_des" name="fourth_des"><?php if(isset($clgtmp['fourth_section_description'])){
                            echo $clgtmp['fourth_section_description'];
                        }?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="fourth_btn_txt">Fourth Section Button Text</label>
                        <input type="text" class="form-control" id="fourth_btn_txt" name="fourth_btn_txt" value="<?php if(isset($clgtmp['fourth_section_button_txt'])){
                            echo $clgtmp['fourth_section_button_txt'];
                        }?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="fourth_back_img">Fourth Section Background Image</label>
                        <input type="file" class="form-control" id="fourth_back_img" name="fourth_back_img" value="">
                        <?php if(isset($clgtmp['fourth_section_background_img'])){?>
                            <img src="./college/uploads/<?php echo $clgtmp['fourth_section_background_img'];
                        ?>" height="100px" width="100px">
                        <?php
                            }
                        ?>
                        
                    </div>
                    <hr>
                    <h4>Fifth Section</h4>
                    <div class="form-group">
                        <label class="form-label" for="fifth_title">Fifth Section Title</label>
                        <input type="text" class="form-control" id="fifth_title" name="fifth_title" value="<?php if(isset($clgtmp['fifth_section_title'])){
                            echo $clgtmp['fifth_section_title'];
                        }?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="fifth_subtitle">Fifth Section SubTitle</label>
                        <input type="text" class="form-control" id="fifth_subtitle" name="fifth_subtitle" value="<?php if(isset($clgtmp['fifth_section_subtitle'])){
                            echo $clgtmp['fifth_section_subtitle'];
                        }?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="fifth_text">Fifth Section Textarea</label>
                        <textarea class="form-control" id="fifth_text" name="fifth_text"><?php if(isset($clgtmp['fifth_section_textarea'])){
                            echo $clgtmp['fifth_section_textarea'];
                        }?></textarea>
                    </div>
                    <hr>
                    <h4>Last Section</h4>
                    <div class="form-group">
                        <label class="form-label" for="last_text">Last Section textarea</label>
                        <textarea class="form-control" id="last_text" name="last_text"><?php if(isset($clgtmp['last_section_textarea'])){
                            echo $clgtmp['last_section_textarea'];
                        }?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="fb_link">Last Section FB link</label>
                        <input type="text" class="form-control" id="fb_link" name="fb_link" value="<?php if(isset($clgtmp['last_section_fb_link'])){
                            echo $clgtmp['last_section_fb_link'];
                        }?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="twitter_link">Last Section Twitter link</label>
                        <input type="text" class="form-control" id="twitter_link" name="twitter_link" value="<?php if(isset($clgtmp['last_section_twitter_link'])){
                            echo $clgtmp['last_section_twitter_link'];
                        }?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="insta_link">Last Section Instagram link</label>
                        <input type="text" class="form-control" id="insta_link" name="insta_link" value="<?php if(isset($clgtmp['last_section_instagram_link'])){
                            echo $clgtmp['last_section_instagram_link'];
                        }?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="linkdn_link">Last Section LinkedIn link</label>
                        <input type="text" class="form-control" id="linkdn_link" name="linkdn_link" value="<?php if(isset($clgtmp['last_section_linkedin_link'])){
                            echo $clgtmp['last_section_linkedin_link'];
                        }?>">
                    </div>
                   
                    <input type="hidden" name="clg_id" id="clg_id" value="<?php echo $clg_id; ?>">
                    <input type="hidden" name="aff_by" id="aff_by" value="<?php echo $modid; ?>">
                    <input type="hidden" name="id" id="id" value="<?php if(isset($clgtmp['id'])){
                        echo $clgtmp['id']; }?>">

                <!-- </div> -->
                <input type="submit" value="submit" class="btn btn-primary mt-2" id="submit">
            </form>
        </div>
    </div><!-- .card-preview -->
</div>

<script>
    
    ClassicEditor.create( document.querySelector( '#first_des' ) );   
    ClassicEditor.create( document.querySelector( '#second_text' ) );
    ClassicEditor.create( document.querySelector( '#fourth_des' ) );
    ClassicEditor.create( document.querySelector( '#fifth_text' ) );
    ClassicEditor.create( document.querySelector( '#last_text' ) );

    $('#btn').click(function(e){
        e.preventDefault();
        
        var html = '<div class="form-group"><label class="form-label" for="third_img">Third Section Image</label><input type="file" class="form-control" id="third_img" name="third_img[]" value=""><label class="form-label" for="third_img_txt">Third Section Image Text</label><input type="text" class="form-control" id="third_img_txt" name="third_img_txt[]" value=""></div>';

        $('.multiimage').append(html);
    })

    $('.remove').click(function(e){
        var data = {
            id:$(this).attr('btn_id'),
            key:$(this).attr('removekey')
        }

        $.ajax({
            url:'./college/remove.php',
            type:"post",
            data:data,
            success:function(response){
                NioApp.Toast('Successfully Removed....','info',{position:'top-right'});
               
            }
        });
    });

    $(document).ready(function(){
        var id = $('#id').val();
        if(id != ''){
                $('#myform').validate({
                rules:{
                    first_title:{
                        required:true
                    },
                    first_des:{
                        required:true
                    },
                    first_btn:{
                        required:true
                    },
                    second_text:{
                        required:true
                    },
                    third_title:{
                        required:true
                    },
                    third_sub_title:{
                        required:true
                    },
                    third_btn_txt:{
                        required:true
                    },
                    fourth_title:{
                        required:true
                    },
                    fourth_des:{
                        required:true
                    },
                    fourth_btn_txt:{
                        required:true
                    },
                    fifth_title:{
                        required:true
                    },
                    fifth_subtitle:{
                        required:true
                    },
                    fifth_text:{
                        required:true
                    },
                    last_text:{
                        required:true
                    },
                    fb_link:{
                        required:true
                    },
                    twitter_link:{
                        required:true
                    },
                    insta_link:{
                        required:true
                    },
                    linkdn_link:{
                        required:true
                    }
                },
                messages:{
                    first_title:"This field is required",
                    first_des:"This field is required",
                    first_btn:"This field is required",
                    second_text:"This field is required",
                    third_title:"This field is required",
                    third_sub_title:"This field is required",
                    third_btn_txt:"This field is required",
                    fourth_title:"This field is required",
                    fourth_des:"This field is required",
                    fourth_btn_txt:"This field is required",
                    fifth_title:"This field is required",
                    fifth_subtitle:"This field is required",
                    fifth_text:"This field is required",
                    last_text:"This field is required",
                    fb_link:"This field is required",
                    twitter_link:"This field is required",
                    insta_link:"This field is required",
                    linkdn_link:"This field is required"
                }
            });
        }else{
            console.log('done');
            $('#myform').validate({
                rules:{
                    logo:{
                        required:true
                    },
                    first_title:{
                        required:true
                    },
                    first_des:{
                        required:true
                    },
                    first_back_img:{
                        required:true
                    },
                    first_btn:{
                        required:true
                    },
                    second_text:{
                        required:true
                    },
                    second_img:{
                        required:true
                    },
                    third_title:{
                        required:true
                    },
                    third_sub_title:{
                        required:true
                    },
                    third_btn_txt:{
                        required:true
                    },
                    fourth_title:{
                        required:true
                    },
                    fourth_des:{
                        required:true
                    },
                    fourth_btn_txt:{
                        required:true
                    },
                    fourth_back_img:{
                        required:true
                    },
                    fifth_title:{
                        required:true
                    },
                    fifth_subtitle:{
                        required:true
                    },
                    fifth_text:{
                        required:true
                    },
                    last_text:{
                        required:true
                    },
                    fb_link:{
                        required:true
                    },
                    twitter_link:{
                        required:true
                    },
                    insta_link:{
                        required:true
                    },
                    linkdn_link:{
                        required:true
                    }
                },
                messages:{
                    logo:"Please select a file",
                    first_title:"This field is required",
                    first_des:"This field is required",
                    first_back_img:"Please select a file",
                    first_btn:"This field is required",
                    second_text:"This field is required",
                    second_img:"Please select a file",
                    third_title:"This field is required",
                    third_sub_title:"This field is required",
                    third_btn_txt:"This field is required",
                    fourth_title:"This field is required",
                    fourth_des:"This field is required",
                    fourth_btn_txt:"This field is required",
                    fourth_back_img:"Please select a file",
                    fifth_title:"This field is required",
                    fifth_subtitle:"This field is required",
                    fifth_text:"This field is required",
                    last_text:"This field is required",
                    fb_link:"This field is required",
                    twitter_link:"This field is required",
                    insta_link:"This field is required",
                    linkdn_link:"This field is required"
                }
            });
        }
    });
</script>

<?php if(isset($_SESSION['success'])){?>
<script>
  
  setTimeout(() =>{
        NioApp.Toast('Successfully Created...','info',{position:'top-right'});
    },1000);

</script>
<?php
    }
    unset($_SESSION['success']);

?>

<?php include_once('footer.php'); ?>