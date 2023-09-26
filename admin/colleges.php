<?php 
    include_once("header.php"); 
    
?>

<div class = "nk-content">
    <?php 
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = $dbConn->editCollege($id);
            $select = $dbConn->selectModerator($id);
        }
    ?>

    <form method="post" id="myform">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label" for="clg">College Name</label>
                <input type="text" class="form-control" id="clg" name="clg" value="<?php if(isset($edit['college_name'])){
                    echo $edit['college_name'];
                }; ?>" placeholder="College name">
            </div>
            <div class="form-group">
                <label class="form-label" for="loc">Location</label>
                <input type="text" class="form-control" id="loc" name="loc" value="<?php if(isset($edit['location'])){
                    echo $edit['location'];
                }?>" placeholder="Location">
                <input type="hidden" id="clg_id" value="<?php if(isset($edit['id'])){
                    echo $edit['id'];
                }?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="mod">Moderator</label>
                <select id="mod" name="mod" class="form-control">
                    <option value="">Select</option>
                <?php foreach ($select as $data) {?>
                    <option value="<?php print_r($data['id']);?>"><?php print_r($data['realname']); ?></option>
                <?php
                }
            ?>
                </select>
            </div>
        </div>
        <input type="submit" value="submit" class="btn btn-primary mt-2" id="submit">
    </form>
</div>

<script>
    $('document').ready(function(){
        $("#myform").validate({
            rules:{
                clg:{
                    required:true
                },
                loc:{
                    required:true
                }
            },
            messages:{
                clg: "Please fill the college name",
                loc: "Please fill the location"
            },
            submitHandler:function(form){
                var formdata = {
                    clg:$('#clg').val(),
                    loc: $('#loc').val(),
                    id:$('#clg_id').val(),
                    action:"add",
                    mod:$('#mod').val(),
                }

                $.ajax({
                    url: "admin/updatestatus.php",
                    type: "POST",
                    data: JSON.stringify(formdata),
                    cache: false,
                    contentType: "application/json",
                    processData: false,
                    dataType: "JSON",
                    success:function(response){
                       // console.log(response);
                        NioApp.Toast('Submitted Successfully', 'info', {position: 'top-right'});
                        $("#myform")[0].reset();
                    }
                });
                return false;
            }
        });
    });
</script>
<?php include_once("footer.php"); ?>