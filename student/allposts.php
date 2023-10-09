<?php include_once('header.php'); ?>

    <div class="nk-content">
        <?php 
          if(isset($_SESSION['users']['id'])){
                $userId = $_SESSION['users']['id'];
                $post = $dbConn->getposts($userId);
          }
        ?> 
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($post as $data){?>
                <tr>
                    <td><img src="student/uploads/<?php print_r($data['image']); ?>" height="200px" width="200px"></td>
                    <td>
                        <a href="student/addposts.php?id=<?php echo $data['id']; ?>" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            <?php 
                }
            ?>
            </tbody>
        </table>

    </div>

<?php include_once('footer.php'); ?>