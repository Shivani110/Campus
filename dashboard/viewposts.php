<?php session_start();
		include_once("DashboardController.php"); 

		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}else{
			$page = 1;
		}
		
        if(isset($_GET['clgid'])){
            $id = $_GET['clgid'];
			
			$data = array($id,$page);
            $post = $dbConn->post($data);
			//print_r(json_decode($post[0]['comments']));
            
        }

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $template = $dbConn->collegeTemplate($id);
        }
		
		if(isset($_SESSION)){
			$userid = $_SESSION['users']['id'];
		}

		$userspost = $dbConn->pagepost();
		$totalpages = $userspost/4;

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Posts</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="css/style.css"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> 
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js">
        </script>
    </head>
	<body>

		<!-- Header -->
		<header id="header">
			<div class="container">

				<div class="navbar-header">
					<!-- Logo -->
					<div class="navbar-brand">
						<a class="logo" href="index.html">
							<img src="http://localhost/shivani/Campus/college/uploads/<?php print_r($template['logo']); ?>" alt="logo">
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
						<li><a href="#">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Courses</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact</a></li>
					</ul>
				</nav>
				<!-- /Navigation -->

			</div>
		</header>
		<!-- /Header -->

		<!-- Hero-area -->
		<div class="hero-area section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url(http://localhost/shivani/Campus/college/uploads/<?php print_r($template['first_section_background_img']); ?>)"></div>
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

							<?php foreach($post as $data){?>
							<div class="col-md-6">
								<div class="single-blog">
									<div class="blog-img">
										<a href="blog-post.html">
											<img src="http://localhost/shivani/Campus/college/uploads/<?php print_r($data['image']); ?>" alt="">
										</a>
									</div>
									<h4><?php print_r($data['text']); ?></h4>
									<div class="blog-meta">
                                        <div class="pull-left">
                                            <button class="fa fa-thumbs-up like-btn" onclick="likepost(<?php print_r($data['id']);?>)"></button>
                                        </div>
										<div class="pull-right comment-box">
											<button class="blog-meta-comments comment" dataid="<?php print_r($data['id']); ?>"><i class="fa fa-comments"></i></button>
											<div id="comment<?php print_r($data['id']); ?>" style="display:none">
												<input type="text" id="cmnt<?php print_r($data['id']); ?>" name="cmnt" class="cmntbox" value="">
												
												<button class="btn btn-primary post" onclick="commentpost(postid=<?php print_r($data['id']);?>)">post</button>
											</div>
											<div><?php 
												if($data['comments'] != null){
													$comments = json_decode($data['comments']);
													
													foreach($comments as $val){
														$value = (array)($val);
														$values = array_values($value);
														$key = array_keys($value);
														
														
														$cmnts = $dbConn->usersdata($key);
													
														?>

														<div><?php if(isset($cmnts[0]['username'])) { echo $cmnts[0]['username']; }?> : <?php if(isset($comments)) {echo $values[0];} ?></div>
														
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
							<!-- /single blog -->
                        </div>

						<div class="row">
							<div class="col-md-12">
								<div class="post-pagination">
									<?php if($page>1){
										echo '<a class="pagination-back pull-left" href = "viewposts.php?id='.$template['id'].'&clgid='.$template['clg_id'].'&page=' . $page-1 . '"> BACK </a>';
									}?>
									<ul class="pages">
									<?php for($i=1; $i<=$totalpages+1; $i++){?>
										<li class="active"><?php echo '<a href = "viewposts.php?id='.$template['id'].'&clgid='.$template['clg_id'].'&page=' . $i . '">' . $i . '</a>'?></li>
									<?php } ?>
									</ul>
									<?php if($page < $totalpages){
										echo '<a class="pagination-next pull-right" href = "viewposts.php?id='.$template['id'].'&clgid='.$template['clg_id'].'&page=' . $page+1 . '"> NEXT </a>';
									}?>
								</div>
							</div>

						</div>
						<!-- /row -->
					</div>
					<!-- /main blog -->

					<!-- aside blog -->
					<div id="aside" class="col-md-3">

						<!-- search widget -->
						<div class="widget search-widget">
							<form>
								<input class="input" type="text" name="search">
								<button><i class="fa fa-search"></i></button>
							</form>
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
							<li><a href="./viewposts.php">Blog</a></li>
							<li><a href="#">Contact</a></li>
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
			</div>
		</footer>
		
        <script>
            const likepost = function(id){
                var data={
                    id:id,
					userid:<?php echo $userid;?>
                }
				//  console.log(data);

                $.ajax({
                    url:'./postlikes.php',
                    type:'POST',
                    data:JSON.stringify(data),
                    cache:false,
                    dataType:"json",
                    contentType:"application/json",
                    success:function(response){
                        console.log(response);
                    }
                });
            }

			$('.comment').click(function(e){
				var id=$(this).attr('dataid');
				// console.log(id);
				$('#comment'+id).toggle();
			})

			const commentpost = function(postid){
					var data ={
						userid:<?php echo $userid;?>,
						postid:$(this).attr('postid'),
						comment:$('#cmnt'+postid).val(),
					} 
					$.ajax({
						url:"./postcomments.php",
						type:"POST",
						data:JSON.stringify(data),
						cache:false,
						dataType:"json",
						contentType:"application/json",
						processData:false,
						success:function(response){
							iziToast.success({
								message: "Comment posted..",
								position: 'topRight'
							});
						}
					});
				}
        </script>

		<div id='preloader'><div class='preloader'></div></div>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
		<script src="http://localhost/shivani/Campus/assets/assets/js/bundle.js?ver=3.1.2"></script>
		<script src="http://localhost/shivani/Campus/assets/assets/js/scripts.js?ver=3.1.2"></script>
		<script src="http://localhost/shivani/Campus/assets/assets/js/charts/gd-default.js?ver=3.1.2"></script>
		<script src="http://localhost/shivani/Campus/assets/assets/js/example-toastr.js?ver=3.1.2"></script>
		<script src="http://localhost/shivani/Campus/assets/assets/js/libs/datatable-btns.js?ver=3.1.2"></script>

	</body>
</html>
