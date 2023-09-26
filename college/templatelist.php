<?php include_once('header.php'); ?>

    <div class="nk-content">
        <?php 
           if(isset($userid)){
                $gettmp = $dbConn->getTemplate($userid);
           }
        ?> 
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Logo</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($gettmp as $data){?>
                <tr>
                  <td><img src="./college/uploads/<?php print_r($data['logo']);?>" height="200px" width="200px"></td>
                  <td><a href="./college/collegeTemplate.php?id=<?php echo $data['id']?>" class="btn btn-primary">Edit</a></td>
                </tr>
            <?php 
                }
            ?>
            </tbody>
        </table>

    </div>

<?php include_once('footer.php'); ?>