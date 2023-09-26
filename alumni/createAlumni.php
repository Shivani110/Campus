<?php 
    include_once("header.php"); 

    $college = $dbConn->collegeName();
?>

    <div class="nk-content">
        <?php
            //print_r($_SESSION);
           // print_r($_SESSION['users']['id'][0]);


          // print_r($college);

          if($_SESSION['users']['id']){
                $id = $_SESSION['users']['id'];

                $alumni = $dbConn->getAlumni($id);
            }
        ?>

        <form method="post" id="myform" enctype="multipart/form-data">
            <div class="col-lg-6">
                <div class="form-group">
                    <?php 
                        foreach($alumni as $data){
                            $clg_id = $data['school'];
                            //print_r($clg_id);
                    ?>
                    <label class="form-label" for="abt_me">About me</label>
                    <textarea class="form-control" id="abt_me" name="abt_me"><?php print_r($data['about_me']); ?> </textarea>
                </div>
                <div class="form-group">
                    <label class="form-label" for="pic">Pictures</label>
                    <img src="./alumni/uploads/<?php print_r($data['pictures']); ?>" height="120px" width="100px">
                    <input type="file" class="form-control" id="file" name="file" value="">
                </div>
                <div class="form-group">
                    <label class="form-label" for="graduate">School Graduated From</label>
                    <select id="graduate" name="graduate">
                        <option value="">Select</option>
                        <?php
                            foreach($college as $clg){ 
                                $id = $clg['id'];

                                if($id == $clg_id){ ?>
                                    <option selected value="<?php print_r($clg['id']); ?>"><?php print_r($clg['college_name']); ?></option> 
                               <?php
                                }else{
                                ?>
                                <option value="<?php print_r($clg['id']); ?>"><?php print_r($clg['college_name']); ?></option>
                            <?php 
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="social">Social Links</label>
                    <input type="text" class="form-control" id="social" name="social" value="<?php print_r($data['social_links']); ?>">
                </div>
                    <?php
                }
                ?>
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['users']['id']; ?>">
            </div>
            <input type="submit" value="Update" class="btn btn-primary mt-2" id="submit">
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
                    graduate:{
                        required:true
                    },
                    social:{
                        required:true
                    }
                },
                messages:{
                    abt_me:"Please fill about me field",
                    // file:"Please select pictures",
                    graduate:"Please fill school graduation",
                    social:"Please enter links"
                },
                submitHandler:function(form){
                    var file = $('#file')[0].files[0];
                    var abt_me = $('#abt_me').val();
                    var graduate = $('#graduate').val();
                    var social = $('#social').val();
                    var user_id = $('#user_id').val();

                    var formdata = new FormData();
                    formdata.append('file',file);
                    formdata.append('abt_me',abt_me);
                    formdata.append('graduate',graduate);
                    formdata.append('social',social);
                    formdata.append('user_id',user_id);

                    $.ajax({
                        url:"alumni/addAlumni.php",
                        type:"post",
                        data:formdata,
                        cache:false,
                        processData:false,
                        contentType:false,
                        dataType:"text",
                        success:function(response){
                            console.log(response);
                            NioApp.Toast('Alumni updated successfully', 'info', {position: 'top-right'});
                        }
                    });
                }
            });
        });
        
    </script>

<?php include_once("footer.php"); ?>