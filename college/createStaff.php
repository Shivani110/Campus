<?php 
    
    include_once("header.php"); 
     
    $college = $dbConn->collegeName();
    //print_r($college);

?>

    <div class="nk-content">
        <?php
            
          // print_r($_SESSION['users']['user_type']);

            if($_SESSION['users']['id']){
                $id = $_SESSION['users']['id'];
                $staff = $dbConn->getStaff($id);
            }
        ?>

        <form method="post" id="myform" enctype="multipart/form-data">
            <div class="col-lg-6">
                <div class="form-group">
                    <?php 
                        foreach($staff as $data){
                            $clg_id = $data['college_name'];
                            //print_r($clg_id );
                    ?>
                    <label class="form-label" for="abt_me">About me</label>
                    <textarea class="form-control" id="abt_me" name="abt_me"><?php print_r($data['about_me']); ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label" for="pic">Pictures</label>
                    <img src="./college/uploads/<?php print_r($data['pictures']); ?>" height="120px" width="100px">
                    <input type="file" class="form-control" id="file" name="file" value="">
                </div>
                <div class="form-group">
                    <label class="form-label" for="clg">College name</label>
                    <select id="clg" name="clg">
                    <option value="">Select</option>
                    <?php 
                        foreach($college as $clg){ 
                            $id = $clg['id'];

                            if($id == $clg_id){
                            ?>
                           <option selected value="<?php print_r($clg['id']); ?>"><?php print_r($clg['college_name']); ?></option>
                     <?php  
                         } else{
                            ?>
                            <option value="<?php print_r($clg['id']); ?>"><?php print_r($clg['college_name']); ?></option>
                         <?php
                         }
                        }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="position">Position</label>
                    <input type="text" class="form-control" id="position" name="position" value="<?php print_r($data['position']); ?>">
                </div>
                <div class="form-group">
                    <label class="form-label" for="dept">Department</label>
                    <input type="text" class="form-control" id="dept" name="dept" value="<?php print_r($data['department']); ?>">
                </div>
                <div class="form-group">
                    <label class="form-label" for="social">Social Links</label>
                    <input type="text" class="form-control" id="social" name="social" value="<?php print_r($data['social_links']); ?>">
                </div>
                <?php
                }
                ?>
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['users']['id'];?>">
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
                    //     // required:true
                    // },
                    clg:{
                        required:true
                    },
                    position:{
                        required:true
                    },
                    dept:{
                        required:true
                    },
                    social:{
                        required:true
                    }
                },
                messages:{
                    abt_me:"Please fill about me",
                    // file:"Please select pictures",
                    clg:"Please fill college name",
                    position:"Please fill position",
                    dept:"Please fill department",
                    social:"Please enter social links"
                },
                submitHandler:function(form){
                    var file = $('#file')[0].files[0];
                    var abt_me = $('#abt_me').val();
                    var clg = $('#clg').val();
                    var position = $('#position').val();
                    var dept = $('#dept').val();
                    var social = $('#social').val();
                    var user_id = $('#user_id').val();

                    var formdata = new FormData();
                    formdata.append('file',file);
                    formdata.append('abt_me',abt_me);
                    formdata.append('clg',clg);
                    formdata.append('position',position);
                    formdata.append('dept',dept);
                    formdata.append('social',social);
                    formdata.append('user_id',user_id);

                    $.ajax({
                        url:"college/addStaff.php",
                        type:"post",
                        data:formdata,
                        cache:false,
                        processData:false,
                        contentType:false,
                        dataType:"text",
                        success:function(response){
                            console.log(response);
                            NioApp.Toast('Staff updated successfully', 'info', {position: 'top-right'});
                        }
                    });
                }
            });
        });
    </script>
<?php include_once("footer.php"); ?>