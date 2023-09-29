<?php include_once("header.php"); 

    if($_SESSION['users']['user_type'] != 0){
        
    }else if($_SESSION['users']['user_type'] != 1){
       
    }else if($_SESSION['users']['user_type'] != 2){
       
    }else if($_SESSION['users']['user_type'] != 3){
        
    }else if($_SESSION['users']['user_type'] != 4){
        
    }else{
        header("location:login.php");
    }
?>
    <div class="nk-content">
        Welcome   <?php print_r($_SESSION['users']);?>
    </div>

<?php include_once("footer.php"); ?>