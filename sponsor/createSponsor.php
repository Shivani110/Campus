<?php include_once("header.php"); 
    
?>

    <div class="nk-content">
        <?php

            if($_SESSION['users']['id']){
                $id = $_SESSION['users']['id'];

                $sponsor = $dbConn->getSponsor($id);
            }
           
           //print_r($id);
        ?>

        <form method="post" id="myform" enctype="multipart/form-data">
            <div class="col-lg-6">
                <div class="form-group">
                    <?php 
                        foreach($sponsor as $data){
                    ?>
                        <label class="form-label" for="abt_me">About me</label>
                        <textarea class="form-control" id="abt_me" name="abt_me"><?php print_r($data['about_me']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="pic">Pictures</label>
                        <img src="./sponsor/uploads/<?php print_r($data['pictures']); ?>" height="120px" width="100px">
                        <input type="file" class="form-control" id="file" name="file" value="">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="support">Types of Support</label>
                        <input type="text" class="form-control" id="support" name="support" value="<?php print_r($data['types_of_support'])?>">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="social">Social Links</label>
                        <input type="text" class="form-control" id="social" name="social" value="<?php print_r($data['social_links']); ?>">
                    </div>
                    <?php
                        }
                    ?>
                <input type="hidden" value="<?php print_r($_SESSION['users']['id']);?>" name="user_id" id="user_id">
                <input type="submit" value="submit" class="btn btn-primary mt-2" id="submit">
        </form>
    </div>

    <script>
        $('document').ready(function(){
            $('#myform').validate({
                rules:{
                    abt_me:{
                        required:true
                    },
                    // file:{
                    //     required:true
                    // },
                    support:{
                        required:true
                    },
                    social:{
                        required:true
                    }
                },
                messages:{
                    abt_me:"Please fill about me",
                    // file:"Please select pictures",
                    support:"Please fill support",
                    social:"Please enter social links"
                },
                submitHandler:function(form){
                    var file = $('#file')[0].files[0];
                    var abt_me = $('#abt_me').val();
                    var support = $('#support').val();
                    var social = $('#social').val();
                    var user_id = $('#user_id').val();

                    var formdata = new FormData();
                    formdata.append('file',file);
                    formdata.append('abt_me',abt_me);
                    formdata.append('support',support);
                    formdata.append('social',social);
                    formdata.append('user_id',user_id);

                    $.ajax({
                        url:"sponsor/addSponsor.php",
                        type:"Post",
                        data:formdata,
                        cache:false,
                        processData:false,
                        contentType:false,
                        dataType:"text",
                        success:function(response){
                            console.log(response);
                            NioApp.Toast('Sponsor updated successfully', 'info', {position: 'top-right'});
                        }
                    });
                }
            });
        });
    </script>
<?php include_once("footer.php"); ?>