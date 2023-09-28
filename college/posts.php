<?php include_once("header.php"); ?>

<div class="nk-content">
    <?php 
        if(isset($clg_id)){
            $id = $clg_id;
            $post = $dbConn->getPost($id);
        }
    ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Posts</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($post as $data){?>
                <tr>
                    <td><img src="./college/uploads/<?php print_r($data['image']); ?>"></td>
                    <td><a href="./college/addpost.php?id=<?php print_r($data['id']); ?>" class="btn btn-primary">Edit</a></td>
                 </tr>
            <?php
            }?>
        </tbody>
    </table>
</div>

<?php include_once("footer.php"); ?>