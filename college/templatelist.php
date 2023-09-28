<?php include_once('header.php'); ?>

    <div class="nk-content">
        <?php 
            // print_r($clg_id);

           if(isset($clg_id)){
                $gettmp = $dbConn->getTemplate($clg_id);
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
                  <td><button class="btn btn-danger" onclick="deleteTemplate(<?php echo $data['id'];?>)">Delete</button></td>
                </tr>
            <?php 
                }
            ?>
            </tbody>
        </table>

    </div>

    <script>
        const deleteTemplate = function(id){
            var data={
                id:id
            }
            $.ajax({
                url:"./college/delete.php",
                type:"post",
                data:JSON.stringify(id),
                cache:false,
                processData:false,
                contentType:"application/json",
                dataType:"JSON",
                success:function(response){
                //    console.log(response);
                   NioApp.Toast('Deleted....', 'info', {position: 'top-right'});
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            })
        }
    </script>

<?php include_once('footer.php'); ?>