<?php 
    session_start();

    include_once('StaffController.php');


    $user_type = $_SESSION['users']['user_type'];
    $user_id = $_SESSION['users']['id'];
    $data = array($user_id,$user_type);
   
    if($data){
        $moderator = $dbConn->getCollege($data);
    }
    
?>
<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title> Staff Dashboard</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="./assets/assets/css/dashlite.css?ver=3.1.2">
    <link rel="stylesheet" href="./assets/assets/css/custom.css">
    <link id="skin-default" rel="stylesheet" href="./assets/assets/css/theme.css?ver=3.1.2">
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js" ></script>
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-menu-trigger">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                    <div class="nk-sidebar-brand">
                        <a href="html/index.html" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                            <img class="logo-dark logo-img" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                        </a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element nk-sidebar-body">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt">Use-Case Preview</h6>
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item has-sub active">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                                        <span class="nk-menu-text">College Authority/Staff</span>
                                    </a>
                                    <ul class="nk-menu-sub" style="display: block;">
                                        <li class="nk-menu-item">
                                            <a href="college/createStaff.php" class="nk-menu-link"><span class="nk-menu-text">Add Staff</span></a>
                                        </li>
                                    </ul><!-- .nk-menu-sub -->
                                </li>
                               
                                <?php foreach($moderator as $mod){
                                        $clg_id = $mod['id'];
                                        // print_r($clg_id);
                                      $modid = $mod['moderator'];
                                    
                                        if($user_id == $modid){?>
                                        <li class="nk-menu-heading">
                                            <h6 class="overline-title text-primary-alt">Dashboards</h6>
                                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                                <span class="nk-menu-icon"></span>
                                                <span class="nk-menu-text">College</span>
                                            </a>
                                            <ul class="nk-menu-sub" style="display: block;">
                                                <li class="nk-menu-item">
                                                    <a href="college/collegeTemplate.php" class="nk-menu-link"><span class="nk-menu-text">College Template</span></a>
                                                    <a href="college/templatelist.php" class="nk-menu-link"><span class="nk-menu-text">College Template List</span></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="nk-menu-heading">
                                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                                <span class="nk-menu-icon"></span>
                                                <span class="nk-menu-text">Posts</span>
                                            </a>
                                            <ul class="nk-menu-sub" style="display: block;">
                                                <li class="nk-menu-item">
                                                    <a href="college/addpost.php" class="nk-menu-link"><span class="nk-menu-text">Add Post</span></a>
                                                    <a href="college/posts.php" class="nk-menu-link"><span class="nk-menu-text">All Posts</span></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="nk-menu-heading">
                                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                                <span class="nk-menu-icon"></span>
                                                <span class="nk-menu-text">Events</span>
                                            </a>
                                            <ul class="nk-menu-sub" style="display: block;">
                                                <li class="nk-menu-item">
                                                    <a href="college/events.php" class="nk-menu-link"><span class="nk-menu-text">Add Events</span></a>
                                                    <a href="college/allevents.php" class="nk-menu-link"><span class="nk-menu-text">All Events</span></a>
                                                    <a href="college/eventStar.php" class="nk-menu-link"><span class="nk-menu-text">Events Star</span></a>
                                                    <a href="college/alleventStar.php" class="nk-menu-link"><span class="nk-menu-text">All Events Star</span></a>
                                                </li>
                                            </ul>
                                        </li>
                                <?php }
                                  }
                                ?><!-- .nk-menu-item -->
                              </ul><!-- .nk-menu -->
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="html/index.html" class="logo-link">
                                    <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                                    <img class="logo-dark logo-img" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                                </a>
                            </div><!-- .nk-header-brand -->
                            <div class="nk-header-news d-none d-xl-block">
                                <div class="nk-news-list">
                                    
                                </div>
                            </div><!-- .nk-header-news -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                     <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-md-block">
                                                    <div class="user-status">Administrator</div>
                                                    <div class="user-name dropdown-indicator">Abu Bin Ishityak</div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span>AB</span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text">Abu Bin Ishtiyak</span>
                                                        <span class="sub-text">info@softnio.com</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="html/user-profile-regular.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                    <li><a href="html/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                                    <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                                                    <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="dbconnect.php?action=logout"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li><!-- .dropdown -->
                                </ul><!-- .nk-quick-nav -->
                            </div><!-- .nk-header-tools -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->