<?php include_once("header.php"); ?>

    <div class="nk-content">
        <?php 
            if(isset($clg_id)){
                $id = $clg_id;
                $event = $dbConn->getevents($id);
               
            }
        ?>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">S.no</th>
                    <th scope="col">Event name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Venue</th>
                    <th scope="col">Sponsorship</th>
                    <th scope="col">Cost</th>
                    <th scope="col">Be_Our_Guest</th>
                    <th scope="col">Guest number</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $i=1;
                    foreach($event as $data){?>
                    <tr>
                        <th scope="col"><?php echo $i++; ?></th>
                        <td><?php print_r($data['event_name']); ?></td>
                        <td><?php print_r($data['date']); ?></td>
                        <td><?php print_r($data['time']); ?></td>
                        <td><?php print_r($data['venue']); ?></td>
                        <td>
                            <?php if($data['sponsorship'] == 1){
                                echo 'Yes';
                            }elseif($data['sponsorship'] == 0){
                                echo 'No';
                            }?>
                        </td>
                        <td><?php print_r($data['cost']); ?></td>
                        <td>
                            <?php if($data['guest'] == 1){
                                echo 'Yes';
                            }elseif($data['guest'] == 0){
                                echo 'No';
                            }
                            
                            ?></td>
                        <td><?php print_r($data['guest_number']); ?></td>
                        <td>
                            <a href="./college/events.php?id=<?php print_r($data['id']); ?>" class="btn btn-primary">Edit</a>
                            <button class="btn btn-danger" onclick="deleteEvent(<?php print_r($data['id']); ?>)">Delete</button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDefault<?php echo $data['id']; ?>">View Guest</button>
                        </td>
                    </tr>
                <?php
                }?>
            </tbody>
        </table>
    </div>
   <?php 
    foreach($event as $data){?>
<!-- Modal Content Code -->
<div class="modal fade" tabindex="-1" id="modalDefault<?php echo $data['id']; ?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
             <?php 
                $guests = json_decode($data['event_guest']); 
                foreach($guests as $guest){
                    if($guest){
                        $users = $dbConn->eventusers($guest);
                    }?>
                    <!-- <table class="table table hover">
                        <thead>
                            <tr>
                                <th scope="col">Guest Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td><?php echo $users[0]["realname"]; ?></td>
                        </tbody>
                    </table> -->
              <?php  }    
            ?>
        </div>
    </div>
</div>
    <?php } ?>
    <script>
        const deleteEvent = function(id){
           var data = {
            id:id
           }
           $.ajax({
                url:"./college/deleteEvents.php",
                type:"Post",
                data:JSON.stringify(id),
                cache:false,
                dataType:"JSON",
                contentType:"application/json",
                processData:"false",
                success:function(response){
                    NioApp.Toast('Deleted events...','info',{position:'top-right'});
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
           })
        }
    </script>
<?php include_once("footer.php"); ?>