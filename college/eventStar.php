<?php include_once("header.php"); ?>

<div class="nk-content">
    <?php 
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $events = $dbConn->eventstar($id);
            // print_r($events);
        }
    ?>

    <div class="eventerror"><h6><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></h6></div>
    <br>
    <form action="./college/addEventstar.php" method="post" id="myform">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="name" class="form-label">Event Name</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php if(isset($events['event_name'])){
                    print_r($events['event_name']);
                } ?>">
            </div>
            <div class="form-group">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" id="slug" name="slug" class="form-control" value="<?php if(isset($events['slug'])){
                    print_r($events['slug']);
                } ?>">
            </div>
            <div class="form-group">
                <label for="role" class="form-label">For</label>
                <select id="role" name="role" class="form-control">
                    <option value="">--Select--</option>
                    <?php if(isset($events['role'])){
                            if($events['role'] == 1){ ?>
                            <option selected value="<?php echo $events['role'] ?>"><?php echo 'Student' ?></option> 
                         <?php }else{ ?>
                             <option value="1">Student</option>
                        <?php }
                            if($events['role'] == 2){ ?>
                            <option selected value="<?php echo $events['role'] ?>"><?php echo 'Staff' ?></option> 
                         <?php }else{ ?>
                            <option value="2">Staff</option>
                         <?php }
                            if($events['role'] == 3){ ?>
                            <option selected value="<?php echo $events['role'] ?>"><?php echo 'Sponsor' ?></option> 
                         <?php }else{ ?>
                            <option value="3">Sponsor</option>
                         <?php } 
                            if($events['role'] == 4){?>
                            <option selected value="<?php echo $events['role'] ?>"><?php echo 'Alumni' ?></option>
                        <?php }else{?>
                            <option value="4">Alumni</option>
                       <?php 
                            }
                       }else { ?>
                        <option value="1">Student</option>
                        <option value="2">Staff</option>
                        <option value="3">Sponsor</option>
                        <option value="4">Alumni</option>
                    <?php } ?>
                <select>
            </div>
            <input type="hidden" name="clg_id" id="clg_id" value="<?php echo $clg_id; ?>">
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
            <input type="hidden" name="id" id="id" value="<?php if(isset($_GET['id'])){
                echo $_GET['id'];
            }?>">

            <input type="submit" class="btn btn-primary" value="Submit">
        </div>
        
    </form>
</div>

<script>
    $(document).ready(function(){
        $('#myform').validate({
            rules:{
                name:{
                    required:true
                },
                slug:{
                    required:true
                },
                role:{
                    required:true
                }
            },
            messages:{
                name:"Please enter the name of event",
                slug:"Please enter slug value",
                role:"Please select"
            }
        })
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

<?php include_once("footer.php"); ?>