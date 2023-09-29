<?php include_once("header.php"); 

    if($_SESSION['users']['user_type'] != 2){
        header("location:login.php");
    }
?>

<div class="nk-content">
    Welcome to Staff dashboard
    <?php print_r($_SESSION); ?>
</div>

<?php include_once("footer.php"); ?>