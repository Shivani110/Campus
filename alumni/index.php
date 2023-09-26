<?php include_once("header.php"); 

    if($_SESSION['user_type'] == 4){
        header("location:login.php");
    }
?>
   

<div class="nk-content">
    Welcome to alumni dashboard <br>
    <?php //print_r($_SESSION['users']['id'][0]); 
       

        print_r($_SESSION);
    ?>
</div>

<?php include_once("footer.php"); ?>
