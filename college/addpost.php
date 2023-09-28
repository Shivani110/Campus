<?php include_once("header.php"); ?>

<div class="nk-content">
    <?php 
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $edit = $dbConn->posts($id);
        }
    ?>
    <form action="./college/createPost.php" method="post" id="myform" enctype="multipart/form-data">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-label" for="image">Image</label>
                    <?php if(isset($edit[0]['image'])){?>
                        <img src='./college/uploads/<?php print_r($edit[0]['image']);?>'>
                    <?php }?>
                    <input type="file" name="image" id="image" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label class="form-label" for="txt">Text</label>
                    <input type="text" name="txt" id="txt" class="form-control" value="<?php if(isset($edit[0]['text'])){
                        print_r($edit[0]['text']);
                    }?>">
                </div>
            </div>
            <input type="hidden" name="clg_id" id="clg_id" value="<?php echo $clg_id; ?>">
            <input type="hidden" name="id" id="id" value="<?php if(isset($_GET['id'])){
                print_r($_GET['id']);
            } ?>">
            <input type="submit" value="Submit" class="btn btn-primary mt-2" id="submit">
    </form>
</div>

<script>
    $(document).ready(function(){
        var id = $('#id').val();

        if(id != ''){
            // console.log(id);
            $('#myform').validate({
                rules:{
                    txt:{
                        required:true
                    }
                },
                messages:{
                    txt:"Please enter text"
                }
            });
        }else{
            // console.log('done');
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
                    image:"Please select a file",
                    txt:"Please enter text"
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