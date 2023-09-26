<?php 
    include_once("header.php"); 
    
    $view = $dbConn->viewCollege();
?>

<div class="nk-content">
    <table class="table table hover">
        <thead>
            <tr>
                <th scope="col">S.No</th>
                <th scope ="col">College Name</th>
                <th scope="col">College Location</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i=1;
                foreach($view as $data){?>
            <tr>
                <th scope="row"><?php echo $i++; ?></th>
                <td><?php echo $data['college_name']; ?></td>
                <td><?php echo $data['location']; ?></td>
                <td><a href="./dashboard/template.php?id=<?php echo $data['id']; ?>" class="btn btn-primary">View</a></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>

<?php include_once("footer.php"); ?>