<?php
	include_once("dbconnect.php");

	if($_POST){
		// print_r($_POST);
		$login = $dbConn->login($_POST);
		
	}
	
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> 
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js" ></script>
</head>
<body>
	<div class="card col-6 offset-3" style="width: 50%;">
		<h1>Login form</h1>
		<form action="login.php" method="POST" name="myform" id="form1">
			<div class="card">
				<label for="u_name">Username or Email-address:</label>
				<input type="text" name="u_name" id="u_name" class="card-body">
				<label for="password">Password:</label>
				<input type="password" name="password" id="password" class="card-body"><br>
				<input type="submit" name="login" value="LogIn" class="btn btn-primary">
			</div>
		</form>
	</div>
</body>
</html>