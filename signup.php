<?php
	include_once('dbconnect.php');

?>
<!DOCTYPE html>
<html>
<head>
<title>Signup</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> 
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js" ></script>
	
</head>
<body>
<div id="msg"></div>
	<div class="container">
		<h1>SignUp form</h1>
		<form method="POST" name="myform" id="form1">
			<div class="col-md-6">
				<div class="form-group">
					<label for="rname" class="form-label">Real name:</label>
					<input type="text" name="rname" id="rname" class="form-control">
				</div>
				<div class="form-group">
					<label for="nick" class="form-label">Nick name:</label>
					<input type="text" name="nick" id="nick" class="form-control">
				</div>
				<div class="form-group">
					<label for="email" class="form-label">E-mail:</label>
					<input type="email" name="email" id="email" class="form-control">
				</div>	
				<div class="form-group">
					<label for="phone" class="form-label">Phone number:</label>
					<input type="text" name="phone" id="phone" class="form-control">
				</div>	
				<div class="form-group">
					<label for="uname" class="form-label">Username:</label>
					<input type="text" name="uname" id="uname" class="form-control">
				</div>	
				<div class="form-group">
					<label for="password" class="form-label">Password:</label>
					<input type="password" name="password" id="password" class="form-control">
				</div>
				<div class="form-group">
					<label for="role" class="form-label">Role:</label>
					<select id="role" name="role" class="form-control">
						<option value="">Select</option>
						<option value="1">Student</option>
						<option value="2">College Authority/Staff</option>
						<option value="3">Sponsor</option>
						<option value="4">Alumni</option>
					</select>
				</div>	

				<input type="submit" name="signup" value="SignUp" class="btn btn-primary">
			</div>
		</form>
	</div>
	<script>
		$(document).ready(function(){
			console.log('done');
			
			$('#form1').validate({
				rules:{
					rname: {
						required:true,
					},
					nick:{
						required:true,
					},
					email:{
						email:true,
						required:true
					},
					phone:{
						required:true,
						maxlength:10
					},
					uname:{
						required:true
					},
					password:{
						required:true,
						maxlength:8
					},
					role:{
						required:true
					}
				},
				messages:{
					rname:"Please fill the realname",
					nick:"Please fill the nickname",
					email:{
						email:"The wrong email format",
						required:"Please fill the email",
					},
					phone:{
						required:"Please fill the phone number",
						maxlength:"The phonenumber is having 10 numbers",
					},
					uname:"Please fill the username",
					password:{
						required:"Please fill the password",
						maxlength:"The password contain only 8 characters",
					},
					role:"Please select your role"
				},
				submitHandler:function(form){
					
					var rname = $('#rname').val();
					var nick = $('#nick').val();
					var email = $('#email').val();
					var phone = $('#phone').val();
					var uname = $('#uname').val();
					var password = $('#password').val();
					var role = $('#role').val();

					var formdata = new FormData();
					formdata.append('rname',rname);
					formdata.append('nick',nick);
					formdata.append('email',email);
					formdata.append('phone',phone);
					formdata.append('uname',uname);
					formdata.append('password',password);
					formdata.append('role',role);
					console.log(formdata);

					$.ajax({
						url:"dbconnect.php",
						type:"post",
						data:formdata,
						cache:false,
						contentType:false,
						processData:false,
						dataType:"text",
						success:function(response){
							//console.log(response);
							$('#msg').html(response);
						}
					});
				}
			});
		});
	</script>
</body>
</html>