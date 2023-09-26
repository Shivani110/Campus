<?php
	require("config.php");


	class DbConnect{
		public $conn;
		public function __construct($host,$user,$password,$db){
			$this->conn = mysqli_connect($host,$user,$password,$db);
			
			if($this->conn){
			}
				
		}
		
		public function register($data){
		//	print_r($data)
			$password = md5($data['password']);
			$realname = $data['rname'];
			$nickname = $data['nick'];
			$email = $data['email'];
			$phone = $data['phone'];
			$username = $data['uname'];
			$user_type = $data['role'];
			
			if(!empty($email) && !empty($username)){
				
				$query = "Select * from users where email='$email' AND username='$username'";
				$result = mysqli_query($this->conn,$query);
				$row = mysqli_num_rows($result);
				
				if($row>0){
					//print_r($data);
					return "Email and username already exist";
				}else{
					$query = "Insert into users (realname,nickname,email,phone,username,password,user_type) values ('$realname','$nickname','$email','$phone','$username','$password','$user_type')";
					
					$result = mysqli_query($this->conn,$query);
					
					return "Data successfully register";
				}
			}
		}
		
		public function login($data){
			// print_r($data);
			$username = $data['u_name'];
			$password = md5($data['password']);
			
			$query = "Select * from users where email = '$username' AND password = '$password' AND is_approved = '1' || username = '$username' AND password = '$password' AND is_approved = '1'" ;
			// print_r($query);

			$result = mysqli_query($this->conn,$query);

			if($result->num_rows > 0){
				$row = mysqli_fetch_array($result);
				
				session_start();

				$_SESSION['users'] = $row;

				if($row['user_type'] == '0'){
					header("location:admin/index.php");
				}else if($row['user_type'] == '1'){
					header("location:student/index.php");
				}else if($row['user_type'] == '2'){
					header("location:college/index.php");
				}else if($row['user_type'] == '3'){
					header("location:sponsor/index.php");
				}else if($row['user_type'] == '4'){
					header("location:alumni/index.php");
				}
			}
		}
	
		public function logout(){
			session_unset();
			session_destroy();

			header("location:login.php");

		}

		public function Close(){
			mysqli_close();
		}
	}
	
	$dbConn = new DbConnect(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABSE);
	//print_r($_GET['action']);

	if(isset($_GET['action'])){
		if($_GET['action'] == 'logout'){

			$logout = $dbConn->logout();
			
		}
	}
	
	if($_POST){
		$register = $dbConn->register($_POST);
		print_r(json_encode($register));
	}
	
?>
