<?php include_once("header.php"); 

    $total = $dbConn->totalevents();
    $totalpages = $total/10;

    if(isset($_GET['page'])){
        $page = $_GET['page'];
        $view = $dbConn->eventsperpage($page);
    }else{
        $page = 1;
    }
    
    if(isset($_SESSION)){
        $userid = $_SESSION['users']['id'];
    }
?>

<div class="nk-content">
    <table class="table table hover">
        <thead>
            <tr>
                <th scope="col">S.no</th>
                <th scope="col">Event Name</th>
                <th scope="col">Venue</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i = 1;
                foreach($view as $data){ 
                   
                ?>
            <tr>
                <th scope="row"><?php echo $i++; ?></th>
                <td><?php echo $data['event_name']; ?></td>
                <td><?php echo $data['venue']; ?></td>
                <td><?php echo $data['date']; ?></td>
                <td><?php echo $data['time']; ?></td>
                <?php if($data['event_guest'] != null){ 
                        $guest = json_decode($data['event_guest']);
                        
                        if(in_array($userid,$guest)){ ?>
                           <td><buttton class="btn btn-info">Joined</button></td>
                    <?php } else{ ?>
                            <td><button class="btn btn-primary" onclick="joinevent(<?php echo $data['id']; ?>)">Join</button></td>
                    <?php }   
                    }else{ ?>
                        <td><button class="btn btn-primary" onclick="joinevent(<?php echo $data['id']; ?>)">Join</button></td>
               <?php }?>
            </tr>
            <?php 
            }?>
        </tbody>

    </table>
    <div class="row">
        <div class="col-md-12">
            <div class="post-pagination">
                <?php if($page>1) {
                    echo '<a class="pagination-back pull-left" href ="dashboard/viewevents.php?page='. $page-1 .'"> BACK </a>';
                }?>
                <ul class="pages">
                <?php for($i=1; $i<=$totalpages+1; $i++){?>
                    <li class="active"><?php echo'<a href="dashboard/viewevents.php?page='.$i.'">'. $i .'</a>'?></li>
                <?php } ?>
                </ul>
                <?php if($page < $totalpages){
					echo '<a class="pagination-next pull-right" href ="dashboard/viewevents.php?page='. $page+1 .'"> NEXT </a>';
				}?>
            </div>
        </div>
    </div>

    <script>
        const joinevent = function(id){
            var data = {
                id:id,
                userid:<?php echo $userid; ?>
            }
            $.ajax({
                url:'dashboard/joinevent.php',
                type:'POST',
                data: JSON.stringify(data),
                cache:false,
                dataType:"JSON",
                contentType:"application/json",
                processData:false,
                success:function(response){
                    NioApp.Toast('Joined', 'info', {position: 'top-right'});
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            })
           
        }
    </script>
</div>

<?php include_once("footer.php"); ?>