<?php include_once("header.php");

?>

    <div class="nk-content ">
        <?php 
        // print_r($_GET['id']);
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                
                $tmp = $dbConn->template($id);
                // print_r($tmp);
            }
        ?>
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">College Template</h3>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="row g-gs">
                            <?php foreach($tmp as $data) {
                                    
                                ?>
                                <div class="col-sm-6 col-lg-4 col-xxl-3">
                                    <div class="gallery card card-bordered">
                                        <div class="gallery-body card-inner align-center justify-between flex-wrap g-2">
                                            <div class="user-card">
                                                <img src="./college/uploads/<?php echo $data['logo'];?>" height="100px" width="100px">
                                                <div>
                                                    <a href="./dashboard/templateview.php?id=<?php echo $data['id']; ?>" class="btn btn-p-0 btn-nofocus">View</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                        </div><!-- .nk-block -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once("footer.php"); ?>