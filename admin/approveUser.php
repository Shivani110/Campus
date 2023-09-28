<?php include_once('header.php'); ?>

    <div class="nk-content">
        <?php
            // $clg = $dbConn->college();
            // print_r($clg);
           
        
        ?>
        <h4> Approved Users </h4>
    
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">S.No.</th>
                    <th scope="col">Realname</th>
                    <th scope="col">Nickname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone number</th>
                    <th scope="col">Username</th>
                    <th scope="col">Role</th>
                    <th scope="col">Is_Approved</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $app = $dbConn->approvedUser();
                    
                    $i = 1;
                    foreach($app as $user){
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
                        
                        <td><?php if($user['is_approved'] == 1){
                               echo "approved";
                        } ?></td>
                        <td><button class="btn btn-danger" onclick="deleteUser(<?php echo $user['id'];?>)">Delete</button></td>
                    </tr>
                    <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
<script>
    const deleteUser = function(id){
        var data = {
            id:id,
        }
        $.ajax({
            type: 'POST',
            url:'./admin/jsonData.php',
            data: JSON.stringify(data),
            dataType:"JSON",
            contentType:"application/json",
            processData:false,
            success:function(response){
                // console.log(response);
                NioApp.Toast('Deleted....','info',{position:'top-right'});
                setTimeout(() =>{
                    location.reload();
                },1000);
            }
        });
    }      
</script>
<?php include_once('footer.php'); ?>