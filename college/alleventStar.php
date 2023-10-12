<?php include_once('header.php'); ?>

    <div class="nk-content">
      <?php 
        if(isset($user_id)){
            $events = $dbConn->getEventStar($user_id);
            // print_r($events);
        }
      
      ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Event Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($events as $data) {?>
                <tr>
                    <td><?php echo $data['event_name']; ?></td>
                    <td>
                        <?php 
                        if($data['role'] == 1){
                            echo 'Student';
                        }elseif($data['role'] == 2){
                            echo 'Staff';
                        }elseif($data['role'] == 3){
                            echo 'Sponsor';
                        }elseif($data['role'] == 4){
                            echo 'Alumni';
                        }
                        ?>
                    </td>
                    <td><a href='./college/eventStar.php?id=<?php echo $data['id'];?>' class="btn btn-primary" >Edit</a></td>
                </tr>
                <?php }?>
            </tbody>
        </table>

    </div>

<?php include_once('footer.php'); ?>