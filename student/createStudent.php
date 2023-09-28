<?php 
    include_once("header.php"); 

    $college = $dbConn->collegeName();
    
?>

<div class = "nk-content">
    <?php 
       if($_SESSION['users']['id']){
            $id = $_SESSION['users']['id'];
            $stu = $dbConn->getStudent($id); 
       }
    ?>

    <form method="post" id="myform" enctype="multipart/form-data">
        <div class="col-lg-6">
            <div class="form-group">
                <?php 
                    foreach($stu as $data){
                        $clg_id = $data['college_name'];
                ?>
                <label class="form-label" for="abt_me">About me</label>
                <textarea class="form-control" id="abt_me" name="abt_me"><?php print_r($data['about_me']); ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="pic">Pictures</label>
                <?php if(isset($data['pictures'])){?>
                    <img src="./student/uploads/<?php print_r($data['pictures']); ?>" height="100px" width="100px">
                <?php
                }?>
                <input type="file" class="form-control" id="file" name="file" value="">
            </div>
            <div class="form-group">
                <label class="form-label" for="course">Course</label>
                <input type="text" class="form-control" id="course" name="course" value="<?php print_r($data['course']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="lev">Level</label>
                <input type="text" class="form-control" id="lev" name="lev" value="<?php print_r($data['level']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="state">State of origin</label>
                <input type="text" class="form-control" id="state" name="state" value="<?php print_r($data['state_of_origin']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="auth">Authenticate Student</label>
                <input type="text" class="form-control" id="auth" name="auth" value="<?php print_r($data['authenticate_student']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="social">Social Links</label>
                <input type="text" class="form-control" id="social" name="social" value="<?php print_r($data['social_link']); ?>">
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
                           <option selected value="<?php print_r($clg['id']); ?>"><?php print_r($clg['college_name'])?></option>
                            <?php
                            }
                            else{
                            ?>
                            <option value="<?php print_r($clg['id']); ?>"><?php print_r($clg['college_name'])?></option> 
                        <?php }
                        }
                    ?>
                <select>
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
    $('document').ready(function(e){
        $('#myform').validate({
            rules:{
                abt_me:{
                    required:true
                },
                // file:{
                //     required:true
                // },
                clg:{
                    required:true
                },
                course:{
                    required:true
                },
                lev:{
                    required:true
                },
                state:{
                    required:true
                },
                auth:{
                    required:true
                },
                social:{
                    required:true
                }
            },
            messages:{
                abt_me:"Please fill the about me",
                // file:"Please select file",
                clg:"Please fill the college name",
                course:"Please fill the course",
                lev:"Please fill the level",
                state:"Please fill the state",
                auth:"Please fill the authentication",
                social:"Please enter links"

            },
            submitHandler:function(form){
                var file = $('#file')[0].files[0];
                var abt_me = $('#abt_me').val();
                var clg = $('#clg').val();
                var course = $('#course').val();
                var lev = $('#lev').val();
                var state = $('#state').val();
                var auth = $('#auth').val();
                var social = $('#social').val();
                var user_id = $('#user_id').val();
                
                var formdata = new FormData();
                formdata.append('file',file);
                formdata.append('abt_me',abt_me);
                formdata.append('clg',clg);
                formdata.append('course',course);
                formdata.append('lev',lev);
                formdata.append('state',state);
                formdata.append('auth',auth);
                formdata.append('social',social);
                formdata.append('user_id',user_id);
                
                $.ajax({
                    url:"student/addstudent.php",
                    type:"Post",
                    data: formdata,
                    cache:false,
                    contentType:false,
                    processData:false,
                    dataType:"text",
                    success:function(response){
                        console.log(response);
                        NioApp.Toast('Student updated successfully', 'info', {position: 'top-right'});
                        setTimeout(() =>{
                            location.reload();
                        },1000);
                    }
                });
            }
        });
    });

</script>

<?php include_once("footer.php"); ?>