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
                        <td><?php print_r($data['sponsorship']); ?></td>
                        <td><?php print_r($data['cost']); ?></td>
                        <td><?php print_r($data['guest']); ?></td>
                        <td><?php print_r($data['guest_number']); ?></td>
                        <td><a href="./college/events.php?id=<?php print_r($data['id']); ?>" class="btn btn-primary">Edit</a></td>
                    </tr>
                <?php
                }?>
            </tbody>
        </table>
    </div>
<?php include_once("footer.php"); ?>