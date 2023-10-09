<?php include_once("header.php"); 
    if(isset($_SESSION)){
        $userid = $_SESSION['users']['id'];
    }
?>

<div class="nk-content">
    <?php
        if(isset($_GET['id'])){
            $pid = $_GET['id'];
            $edit = $dbConn->editposts($pid);
        } 
    ?>
    <form action="./alumni/createPost.php" method="post" enctype="multipart/form-data" id="myform">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label" for="image">Image</label>
                <?php if(isset($edit[0]['image'])){ ?>
                    <img src="alumni/uploads/<?php print_r($edit[0]['image']); ?>">
                <?php }?>
                <input type="file" name="image" id="image" class="form-control" value="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label" for="txt">Text</label>
                <input type="text" name="txt" id="txt" class="form-control" value="<?php if(isset($edit[0]['text'])){
                    print_r($edit[0]['text']);
                }?>">
            </div>
        </div>
        <input type="hidden" name="userid" id="userid" value="<?php echo $userid; ?>">
        <input type="hidden" name="post_id" id="post_id" value="<?php if(isset($edit[0]['id'])){
            print_r($edit[0]['id']); } ?>">
        <input type="submit" value="Submit" class="btn btn-primary mt-2" id="submit">
    </form>
</div>

<script>
    $(document).ready(function(){
        var id = $('#post_id').val();
        if(id == ''){
            $('#myform').validate({
                rules:{
                    image:{
                        required:true
                    },
                    txt:{
                        required:true
                    }
                },
                messages:{
                    image: "Please select file",
                    txt: "Please enter text"
                }
            });
        }
    });    
</script>

<?php if(isset($_SESSION['success'])){?>
<script>
    setTimeout(() =>{
        NioApp.Toast('Post Created...','info',{position:'top-right'});
    },1000);
</script>
<?php
    }
    unset($_SESSION['success']);
?>
<?php include_once("footer.php"); ?>