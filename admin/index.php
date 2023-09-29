<?php include_once("header.php"); 
    
    if($_SESSION['users']['user_type'] == 0){
        
    }else{
        header("location:login.php");
    }

?>

<div class = "nk-content">
   <h4> Welcome to admin dashboard</h4>
    
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">Realname</th>
                <th scope="col">Nickname</th>
                <th scope="col">Email</th>
                <th scope="col">Phone number</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        
            <?php 

                $showUser = $dbConn->showUser($_SESSION);

                $cnt = count($showUser);
                    $i = 1;

                    foreach($showUser as $user){
                    ?>

                   <tr>
                    <th scope="row"><?php echo $i++; ?></th>
                    <td><?php echo $user['realname']; ?></td>
                    <td><?php echo $user['nickname']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['phone']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td>
                        <?php  
                            if($user['user_type'] == 1){
                                echo "Student";
                            }else if($user['user_type'] == 2){
                                echo "College Authority/Staff";
                            }else if($user['user_type'] == 3){
                                echo "Sponsor";
                            }else if($user['user_type'] == 4){
                                echo "Alumni";
                            }
                        ?>
                    </td>
                    <!-- <td><a id="status" href="./admin/updatestatus.php?id=<?php echo $user['id'];?>&is_approved=<?php echo $user['is_approved'];?>">Approved</a></td> -->
                    <td><button class="btn btn-primary" onclick="updateStatus(<?php echo $user['id'];?>)">Approved</button></td>
                    <td><button class="btn btn-danger" onclick="deleteUsers(<?php echo $user['id'];?>)">Disapproved</button></td>
                </tr>
            <?php
                }
            ?>
        </tbody>
</table>
</div>

<script>
  const updateStatus= function(id){
    var data = {
        action:"approved",
        id:id,
    }
    $.ajax({
        type: 'POST',
        url: './admin/updatestatus.php',
        data: JSON.stringify(data),
        dataType:"JSON",
        cache:false,
        contentType:"application/json",
        processData:false,
        success: function(response){
            //console.log(response);
            NioApp.Toast('Successfully approved', 'info', {position: 'top-right'});
            setTimeout(() => {
                location.reload();
            }, 1000);
        } 
    });
  }

    const deleteUsers = function(id){
        var data = {
            action:"disapproved",
            id:id,
        }
        $.ajax({
            type: 'POST',
            url:'./admin/updatestatus.php',
            data: JSON.stringify(data),
            dataType:"JSON",
            contentType:"application/json",
            processData:false,
            success:function(response){
                
                NioApp.Toast('Disapproved....','info',{position:'top-right'});
                setTimeout(() =>{
                    location.reload();
                },1000);
            }
        });
    }  
</script>

<?php include_once("footer.php"); ?>