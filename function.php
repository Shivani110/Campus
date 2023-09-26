<?php
	require_once("dbconnect.php");
	session_start();
	
	class dbFunction{
		
		function __construct(){
			$db = new dbConnect();
		}
		
		public function UserRegister($realname,$nickname,$email,$phone_no,$u_name,$password,$role){
			print_r($realname);
			die();
			$password = md5($password);
			$query = mysql_query("Insert into users(realname,nickname,email,phone,username,password,user_type) values ('$realname','$nickname','$email','$phone_no','$u_name','$password','$role')");
			
			return $query;
		}
		
		public function userExist($email){
			$query = mysql_query("Select * from campus where email = '$email'");
			$row = mysql_num_rows($query);
			if($row>0){
				return true;
			}else{
				return false;
			}
		} 
	}
?>