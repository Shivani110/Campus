<?php 
    include_once("header.php"); 

    $result = $dbConn->showCollege();
    // print_r($result);
?>

    <div class="nk-content">
    <?php 
      
    ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">S.No.</th>
                    <th scope="col">College Name</th>
                    <th scope="col">Location</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $i = 1;
                    foreach($result as $data){
                    ?>
                    <tr>
                        <th scope="row"><?php echo $i++; ?>
                        <td><?php echo $data['college_name']; ?></td>
                        <td><?php echo $data['location']; ?></td>
                        <td>
                            <a href="admin/colleges.php?id=<?php echo $data['id']; ?>"  class="btn btn-success">Edit</a>
                            <a class="btn btn-danger deletebtn" data_id="<?php echo $data['id']; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
<script>
    $('.deletebtn').click(function(e){
        e.preventDefault();
       var data={
        id: $(this).attr('data_id'),
        action: "delete",
       }
       //console.log(id);
        $.ajax({
           url:"./admin/updatestatus.php",
            type:"post",
            data: JSON.stringify(data),
            cache:false,
            contentType:"application/json",
            processData:false,
            dataType:"JSON",
            success: function(response){
            
            NioApp.Toast('Deleted Successfully', 'info', {position: 'top-right'});
            setTimeout(() => {
                location.reload();
            }, 1000);
        } 
        });
    });
</script>    
<?php include_once("footer.php"); ?>