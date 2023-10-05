<?php include_once("header.php"); ?>

<div class="nk-content">
    <?php 
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $event = $dbConn->events($id);
        }?>
    <form action="./college/createEvents.php" method="post" id="myform">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="event_name" class="form-label">Event Name</label>
                <input type="text" id="event_name" name="event_name" class="form-control" value="<?php if(isset($event[0]['event_name'])){
                    echo $event[0]['event_name'];
                }?>">
            </div>
            <div class="form-group">
                <label for="date" class="form-label">Date</label>
                <input type="date" id="date" name="date" class="form-control" value="<?php if(isset($event[0]['date'])){
                    echo $event[0]['date'];
                }?>">
            </div>
            <div class="form-group">
                <label for="time" class="form-label">Time</label>
                <input type="time" id="time" name="time" class="form-control" value="<?php if(isset($event[0]['time'])){
                    echo $event[0]['time'];
                }?>">
            </div>
            <div class="form-group">
                <label for="venue" class="form-label">Venue</label>
                <input type="text" id="venue" name="venue" class="form-control" value="<?php if(isset($event[0]['venue'])){
                    echo $event[0]['venue'];
                }?>">
            </div>
            <div class="form-group">
                <label for="sponsorship" class="form-label">Sponsorship needed ?</label>
                <?php if(isset($event[0]['sponsorship'])){
                        if($event[0]['sponsorship'] == 1){?>
                            <input type="checkbox" id="sponsorship1" name="sponsorship" value="1" class="checkoption" checked>YES
                       <?php }else { ?>
                             <input type="checkbox" id="sponsorship1" name="sponsorship" value="1" class="checkoption">YES
                       <?php }
                       if($event[0]['sponsorship'] == 0){ ?>
                            <input type="checkbox" id="sponsorship2" name="sponsorship" value="0" class="checkoption" checked>NO
                       <?php } else{ ?>
                            <input type="checkbox" id="sponsorship2" name="sponsorship" value="0" class="checkoption">NO
                        <?php  }
                        }else{?>
                            <input type="checkbox" id="sponsorship1" name="sponsorship" value="1" class="checkoption">YES
                            <input type="checkbox" id="sponsorship2" name="sponsorship" value="0" class="checkoption">NO
                <?php }?>
            </div>
            <div class="form-group">
                <label for="cost" class="form-label">Cost</label>
                <input type="text" id="cost" name="cost" class="form-control" value="<?php if(isset($event[0]['cost'])){
                    echo $event[0]['cost'];
                }?>">
            </div>
            <div class="form-group">
                <label for="guest" class="form-label">Be our guest</label>
                <?php if(isset($event[0]['guest'])){
                        if($event[0]['guest'] == 1){ ?>
                        <input type="checkbox" id="guest1" name="guest" value="1" class="checkoption2" checked>YES
                   <?php }else{ ?>
                        <input type="checkbox" id="guest1" name="guest" value="1" class="checkoption2">YES
                   <?php }
                        if($event[0]['guest'] == 0){ ?>
                            <input type="checkbox" id="guest2" name="guest" value="0" class="checkoption2" checked>NO
                    <?php }else{ ?>
                            <input type="checkbox" id="guest2" name="guest" value="0" class="checkoption2">NO
                    <?php }
                }else{ ?>
                    <input type="checkbox" id="guest1" name="guest" value="1" class="checkoption2">YES
                    <input type="checkbox" id="guest2" name="guest" value="0" class="checkoption2">NO
               <?php }?>
            </div>
            <div class="form-group">
                <label for="guest_num" class="form-label">Event guest number</label>
                <input type="text" id="guest_num" name="guest_num" class="form-control" value="<?php if(isset($event[0]['guest_number'])){
                    echo $event[0]['guest_number'];
                }?>">
            </div>
            <input type="hidden" name="created_by" id="created_by" value="<?php echo $modid; ?>">
            <input type="hidden" name="affilated_by" id="affilated_by" value="<?php echo $clg_id; ?>">
            <input type="hidden" name="id" id="id" value="<?php if(isset($_GET['id'])){
                print_r($_GET['id']);
            } ?>">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>
    </form>
</div>
    <script>
        $(document).ready(function(){
            $('.checkoption').click(function(){
                $('.checkoption').not(this).prop('checked', false);
            });
            
            $('.checkoption2').click(function(){
                $('.checkoption2').not(this).prop('checked', false);
            });
            
            $('#myform').validate({
                rules:{
                    event_name:{
                        required:true
                    },
                    date:{
                        required:true
                    },
                    time:{
                        required:true
                    },
                    venue:{
                        required:true
                    },
                    cost:{
                        required:true
                    },
                    guest_num:{
                        required:true
                    }
                },
                messages:{
                    event_name:"Please enter event name",
                    date:"Please enter date",
                    time:"Please enter time",
                    venue:"Please enter venue",
                    cost:"Please enter cost",
                    guest_num:"Please enter guest number"
                }
            });
        });
    </script>

    <?php if(isset($_SESSION['success'])){ ?>
    <script> 
        setTimeout(() =>{
            NioApp.Toast('Event Created...','info',{position:'top-right'});
        },1000);
    </script>
    <?php }
       unset($_SESSION['success']);
    ?>
<?php include_once("footer.php"); ?>