<?php 
    session_start();
	include_once("DashboardController.php"); 

    $posts = $dbConn->getusers();

    if(isset($_SESSION)){
        $userid = $_SESSION['users']['id'];
		$username = $_SESSION['users']['realname'];
    }

	
	
        
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Public Posts</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="./assets/assets/css/dashlite.css?ver=3.1.2">
    	<link id="skin-default" rel="stylesheet" href="./assets/assets/css/theme.css?ver=3.1.2">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> 
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js">
        </script>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>

		<!-- Header -->
		<header id="header">
			<div class="container">

				<div class="navbar-header">
					<!-- Logo -->
					<div class="navbar-brand">
						<a class="logo" href="index.html">
							<img src="./img/logo.png" alt="logo">
						</a>
					</div>
					<!-- /Logo -->

					<!-- Mobile toggle -->
					<button class="navbar-toggle">
						<span></span>
					</button>
					<!-- /Mobile toggle -->
				</div>

				<!-- Navigation -->
				<nav id="nav">
					<ul class="main-menu nav navbar-nav navbar-right">
						<li><a href="index.html">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Courses</a></li>
						<li><a href="blog.html">Blog</a></li>
						<li><a href="contact.html">Contact</a></li>
					</ul>
				</nav>
				<!-- /Navigation -->

			</div>
		</header>
		<!-- /Header -->

		<!-- Hero-area -->
		<div class="hero-area section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background.jpg)"></div>
			<!-- /Backgound Image -->

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<ul class="hero-area-tree">
							<li><a href="index.html">Home</a></li>
							<li>Blog</li>
						</ul>
						<h1 class="white-text">Blog Page</h1>

					</div>
				</div>
			</div>

		</div>
		<!-- /Hero-area -->

		<!-- Blog -->
		<div id="blog" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- main blog -->
					<div id="main" class="col-md-9">

						<!-- row -->
						<div class="row">

                        <?php foreach($posts as $data){?>
							<div class="col-md-6">
								<div class="single-blog">
									<div class="blog-img">
                                        <?php if($data['user_type'] == 1) { ?>
                                            <a href="blog-post.html">
											<img src="http://localhost/shivani/Campus/student/uploads/<?php print_r($data['image']); ?>" alt="">
										</a>
                                       <?php }else if($data['user_type'] == 2) {?>
										<a href="blog-post.html">
											<img src="http://localhost/shivani/Campus/college/uploads/<?php print_r($data['image']); ?>" alt="">
										</a>
                                        <?php }else if($data['user_type'] == 3) {?>
										<a href="blog-post.html">
											<img src="http://localhost/shivani/Campus/sponsor/uploads/<?php print_r($data['image']); ?>" alt="">
										</a>
                                        <?php }else if($data['user_type'] == 4) {?>
										<a href="blog-post.html">
											<img src="http://localhost/shivani/Campus/alumni/uploads/<?php print_r($data['image']); ?>" alt="">
										</a>
                                        <?php }?>
									</div>
									<h4><?php print_r($data['text']); ?></h4>
									<div>
										Posted by: <?php print_r($data['realname']); ?>
									</div>
										<?php 
											$pu_id = $data['user_id']; 
											$profiles = $dbConn->userpictures($pu_id);
										?>
										<div>
											<?php if($data['user_type'] == 1){ ?>
												<img src="http://localhost/shivani/Campus/student/uploads/<?php print_r($profiles['pictures']); ?>" height="40px" width="40px">
											<?php }elseif($data['user_type'] == 2){?>
												<img src="http://localhost/shivani/Campus/college/uploads/<?php print_r($profiles['pictures']); ?>" height="40px" width="40px">
											<?php }elseif($data['user_type'] == 3){?>	
												<img src="http://localhost/shivani/Campus/sponsor/uploads/<?php print_r($profiles['pictures']); ?>" height="40px" width="40px">
											<?php }elseif($data['user_type'] == 4){?>
												<img src="http://localhost/shivani/Campus/alumni/uploads/<?php print_r($profiles['pictures']); ?>" height="40px" width="40px">
											<?php } ?>	
										</div>

									<div class="blog-meta">
										<?php $likeid = $data['id'];
											$likes = $dbConn->userslikes($likeid);
											$like = json_decode($likes['likes']);

											if($like != null){
												if(in_array($userid,$like)){ ?>
													<div class="pull-left like" id="dislike<?php print_r($data['id']); ?>" onclick="likepost(<?php print_r($data['id']);?>)">
														<button class="fa fa-thumbs-down dislike-btn" d_likeid="<?php print_r($data['id']);?>">
													</div>
											<?php	
												}else{ ?>
													<div class="pull-left" id="like<?php print_r($data['id']); ?>"> 
														<button class="fa fa-thumbs-up like-btn" likeid="<?php print_r($data['id']);?>" onclick="likepost(<?php print_r($data['id']);?>)"></button>
													</div>
											<?php	}
											}else{ ?>
												<div class="pull-left" id="like<?php print_r($data['id']); ?>">
													<button class="fa fa-thumbs-up like-btn" likeid="<?php print_r($data['id']);?>" onclick="likepost(<?php print_r($data['id']);?>)"></button>
												</div>
											<?php	
												}
											?>

										<div class="pull-right comment-box">
											<button class="blog-meta-comments comment" dataid="<?php print_r($data['id']); ?>"><i class="fa fa-comments"></i></button>
											<div id="comment<?php print_r($data['id']); ?>" style="display:none">
												<input type="text" id="cmnt<?php print_r($data['id']); ?>" name="cmnt" class="cmntbox" value="">
												<span class="error"><p id="comment_error<?php print_r($data['id']); ?>"></p></span>
												<button class="btn btn-primary post" onclick="postcomment(<?php print_r($data['id'])?>)">Comment</button>
											</div>
											<div id="showcomments<?php print_r($data['id']); ?>" style="display:none">
												<?php 
													if($data['comments'] != null){
														$comments = json_decode($data['comments']);
														
														foreach($comments as $val){
															$value = (array)($val);
															$values = array_values($value);
															$key = array_keys($value);

															$cmnts = $dbConn->usersdata($key);
														?>
													<div><?php if(isset($cmnts[0]['username'])) { echo $cmnts[0]['username']; }?>: <?php if(isset($comments)) {echo $values[0];} ?> </div>	
													<?php }	
													}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php 
                            }?>
						</div>
						<!-- /row -->

						<!-- row -->
						<div class="row">

							<!-- pagination -->
							<div class="col-md-12">
								<div class="post-pagination">
									<!-- <a href="#" class="pagination-back pull-left">Back</a>
									<ul class="pages">
										<li class="active">1</li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#">4</a></li>
									</ul>
									<a href="#" class="pagination-next pull-right">Next</a> -->
								</div>
							</div>
							<!-- pagination -->

						</div>
						<!-- /row -->
					</div>
					<!-- /main blog -->

					<!-- aside blog -->
					<div id="aside" class="col-md-3">

						<!-- search widget -->
						<div class="widget search-widget">
							<input type="text" name="search" id="search" class="input" val=''>
							<button class="srch-btn"><i class="fa fa-search"></i></button>
						</div>
						<!-- /search widget -->

						<!-- category widget -->
						<div class="widget category-widget">
							<h3>Categories</h3>
							<a class="category" href="#">Web <span>12</span></a>
							<a class="category" href="#">Css <span>5</span></a>
							<a class="category" href="#">Wordpress <span>24</span></a>
							<a class="category" href="#">Html <span>78</span></a>
							<a class="category" href="#">Business <span>36</span></a>
						</div>
						<!-- /category widget -->

						<!-- posts widget -->
						<div class="widget posts-widget">
							<h3>Recents Posts</h3>

							<!-- single posts -->
							<div class="single-post">
								<a class="single-post-img" href="blog-post.html">
									<img src="./img/post01.jpg" alt="">
								</a>
								<a href="blog-post.html">Pro eu error molestie deserunt.</a>
								<p><small>By : John Doe .18 Oct, 2017</small></p>
							</div>
							<!-- /single posts -->

							<!-- single posts -->
							<div class="single-post">
								<a class="single-post-img" href="blog-post.html">
									<img src="./img/post02.jpg" alt="">
								</a>
								<a href="blog-post.html">Pro eu error molestie deserunt.</a>
								<p><small>By : John Doe .18 Oct, 2017</small></p>
							</div>
							<!-- /single posts -->

							<!-- single posts -->
							<div class="single-post">
								<a class="single-post-img" href="blog-post.html">
									<img src="./img/post03.jpg" alt="">
								</a>
								<a href="blog-post.html">Pro eu error molestie deserunt.</a>
								<p><small>By : John Doe .18 Oct, 2017</small></p>
							</div>
							<!-- /single posts -->

						</div>
						<!-- /posts widget -->

						<!-- tags widget -->
						<div class="widget tags-widget">
							<h3>Tags</h3>
							<a class="tag" href="#">Web</a>
							<a class="tag" href="#">Photography</a>
							<a class="tag" href="#">Css</a>
							<a class="tag" href="#">Responsive</a>
							<a class="tag" href="#">Wordpress</a>
							<a class="tag" href="#">Html</a>
							<a class="tag" href="#">Website</a>
							<a class="tag" href="#">Business</a>
						</div>
						<!-- /tags widget -->

					</div>
					<!-- /aside blog -->

				</div>
				<!-- row -->

			</div>
			<!-- container -->

		</div>
		<!-- /Blog -->

		<!-- Footer -->
		<footer id="footer" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- footer logo -->
					<div class="col-md-6">
						<div class="footer-logo">
							<a class="logo" href="index.html">
								<img src="./img/logo.png" alt="logo">
							</a>
						</div>
					</div>
					<!-- footer logo -->

					<!-- footer nav -->
					<div class="col-md-6">
						<ul class="footer-nav">
							<li><a href="index.html">Home</a></li>
							<li><a href="#">About</a></li>
							<li><a href="#">Courses</a></li>
							<li><a href="blog.html">Blog</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
					</div>
					<!-- /footer nav -->

				</div>
				<!-- /row -->

				<!-- row -->
				<div id="bottom-footer" class="row">

					<!-- social -->
					<div class="col-md-4 col-md-push-8">
						<ul class="footer-social">
							<li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
							<li><a href="#" class="youtube"><i class="fa fa-youtube"></i></a></li>
							<li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
						</ul>
					</div>
					<!-- /social -->

					<!-- copyright -->
					<div class="col-md-8 col-md-pull-4">
						<div class="footer-copyright">
							<span>&copy; Copyright 2018. All Rights Reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com">Colorlib</a></span>
						</div>
					</div>
					<!-- /copyright -->

				</div>
				<!-- row -->

			</div>
			<!-- /container -->

		</footer>
		<!-- /Footer -->
    <script>
        const likepost = function(id){
            var data={
                id:id,
                userid:<?php echo $userid;?>
            }

            $.ajax({
                url:'./likes.php',
                type:'POST',
                data:JSON.stringify(data),
                cache:false,
                dataType:"json",
                contentType:"application/json",
                success:function(response){
					const array = response;

					if(array.includes(data.userid)){
						console.log('like')
						var html = '<div class="pull-left like" id="dislike'+id+'"><button class="fa fa-thumbs-down dislike-btn" d_likeid="'+id+'" onclick="likepost('+id+')"></div>';
						$('#like'+id).html(html);
					}else{
						console.log('dislike')
						var html = '<div class="pull-left" id="like'+id+'"><button class="fa fa-thumbs-up like-btn" likeid="'+id+'" onclick="likepost('+id+')"></button></div>';
						$('#dislike'+id).html(html);
					}
                }
            });
		}

		$('.comment').click(function(e){
			var id=$(this).attr('dataid');
			$('#comment'+id).toggle();
			$('#showcomments'+id).toggle();
		})

		const postcomment = function(id){
			var data = {
				id: id,
				userid:<?php echo $userid;?>,
				comment:$('#cmnt'+id).val(),
			}
			$.ajax({
				url:"./comments.php",
				type:"post",
				data:JSON.stringify(data),
				cache:false,
                dataType:"json",
                contentType:"application/json",
				success:function(response){
					var comments = data.comment;
					var username = "<?php print_r($_SESSION['users']['realname']); ?>"
					var html = '<div>'+username+':'+comments+'</div>';
					
					$('#showcomments'+id).append(html);
					$('#cmnt'+id).val('');
				}
			})
		}
		
		$(".srch-btn").click(function(){
			var data ={
				search: $('#search').val()
			}
			$.ajax({
				url:"./searchpost.php",
				type:"post",
				data:JSON.stringify(data),
				cache:false,
                dataType:"json",
                contentType:"application/json",
				success:function(response){
					console.log(response);
				}
			})
		});
    </script>
		<!-- preloader -->
		<div id='preloader'><div class='preloader'></div></div>
		<!-- /preloader -->


		<!-- jQuery Plugins -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/main.js"></script>

	</body>
</html>
