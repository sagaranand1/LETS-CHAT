<!DOCTYPE HTML>
<html>
<head>
<title>Create New password</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto|Courgette|Pacifico:400,700" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/signin.css">
</head>
<body>
<div class="signin-form">
<form action="" method="post">
<div class="form-header">
<h1>Create New password</h1>
<p>MyChat</p>
</div>
<div class="form-group">
<label>Enter Password</label>
<input type="password" class="form-control" name="pass1" placeholder="Enter password" autocomplete="off" required></input>
</div>
<div class="form-group">
<label>Confirm Password</label>
<input type="password" class="form-control" name="pass2" placeholder="Confirm Password" autocomplete="off" required></input>
</div>
<div class="form-group">
<button type="submit" class="btn btn-primary btn-block btn-lg" name="change">Change</button>
</div>
</form>
</div>
<?php
session_start();
include("include/connection.php");
if(isset($_POST['change'])){
	$user=$_SESSION['user_email'];
	$pass1=$_POST['pass1'];
	$pass2=$_POST['pass2'];
	if($pass1!=$pass2){
		echo "
			<div class='alert alert-danger'>
				<center><strong>Your new password didn't match with confirm password.</strong></center>
			</div>
		";
	}		
	
	if(strlen($pass1)<8 AND strlen($pass2)<8){
		echo "
			<div class='alert alert-danger'>
				<center><strong>Use 9 or more than 9 characters.</strong></center>
			</div>
		";
	}
	
	if($pass1==$pass2){
		$update_pass=mysqli_query($con,"update users set user_pass='$pass1' where user_email='$user'");
		session_destroy();
		
		echo "<script>alert('Go ahead and signin.');</script>";
		echo "<script>window.open('signin.php','_self')</script>";
	}
	
}
?>
</body>
</html>
