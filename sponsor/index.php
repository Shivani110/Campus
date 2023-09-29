<?php include_once("header.php"); 

    if($_SESSION['users']['user_type'] != 3){
        header("location:login.php");
    }
?>

<div class="nk-content">
    Welcome to Sponsor dashboard
    <?php print_r($_SESSION); ?>
</div>

<?php include_once("footer.php"); ?>